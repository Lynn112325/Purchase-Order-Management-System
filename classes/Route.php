<?php
class Route
{

    // 定義一個靜態屬性 $routes，用來存儲所有的路由映射
    private static $routes = ['GET' => [], 'POST' => []];
    // 定義兩個靜態屬性，用來存儲編譯過的 URL 模式和當前的 URL Prefix(前綴)、避免重複計算。
    private static $compiledPatterns = [];
    private static $currentPrefix = '';

    // map(): 將 HTTP 方法、URL 模式（轉換為正則）和處理函數組合後存入routes數組。
    public static function map($method, $pattern, $handler)
    {
        // 將 HTTP 方法轉換為大寫(GET、POST)
        $method = strtoupper($method);
        $pattern = self::$currentPrefix . $pattern;
        // 將路由模式和處理函數存入對應的數組中

        // 
        if (is_string($handler) && strpos($handler, '@') !== false) {
            list($class, $function) = explode('@', $handler, 2);
            $classObj = new $class();
            $handler = [$classObj, $function]; //
        }
        self::$routes[$method][] = [
            'pattern' => self::compilePattern($pattern),
            'handler' => $handler
        ];
    }



    // Converts route patterns with dynamic parameters(動態參數) (e.g., {id}) into regex patterns(正則表達式).
    private static function compilePattern($pattern)
    {
        // 如果編譯過的 URL 模式不存在，則進行編譯
        if (!isset(self::$compiledPatterns[$pattern])) {
            // preg_replace_callback：替換 URL 模式中的動態參數（如 {id}）為正則表達式
            $regex = preg_replace_callback(
                '/\{(\w+)(?::([^}]+))?\}/',
                // $matches[1]：var名（如 id）
                // $matches[2]：var模式（如 \d+）（匹配一個或多個數字）
                function ($matches) {
                    // 如果未指定模式，則使用預設模式[^/]+ (匹配除 / 之外的任意字符)
                    $pattern = $matches[2] ?? '[^/]+';
                    return "(?<{$matches[1]}>$pattern)";
                },
                $pattern
            );
            // 將編譯後的 URL 模式存入緩存
            self::$compiledPatterns[$pattern] = '#^' . $regex . '$#';
        }
        return self::$compiledPatterns[$pattern];
    }

    // Matches the request method and URI against registered routes.
    // Extracts dynamic parameters from the URL and passes them to the handler.
    // dispatch(): 遍歷所有路由，匹配當前請求的 URL 和方法，調用對應的處理函數。
    public static function dispatch()
    {
        // error_log("=== Try Dispatching ===");
        // 獲取當前請求的方法和 URI
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        error_log("Dispatching: " . $requestUrl);

        // parse_url 是 PHP 的一個內置函數，它將 URI 拆分為多個組件（如協議、主機、路徑、查詢字符串等）。
        // $_SERVER['REQUEST_URI']：當前請求的 URI
        // PHP_URL_PATH：僅返回路徑部分
        $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // 调试输出开始
        // error_log("=== Routes Debug ===");
        // error_log("Request Method: $requestMethod");
        // error_log("Request URI: $requestUri");
        // error_log("Current Prefix: " . self::$currentPrefix);
        // error_log("Registered Routes： ");
        // foreach (self::$routes as $method => $routes) {
        //     error_log("$method: ");
        //     foreach ($routes as $index => $route) {
        //         error_log("  [$index] pattern: {$route['pattern']}");
        //     }
        // }
        // 遍歷所有路由，查找匹配的路由
        foreach (self::$routes[$requestMethod] ?? [] as $route) {
            // error_log("Checking pattern: " . $route['pattern']);
            if (preg_match($route['pattern'], $requestUrl, $matches)) {
                // error_log("Matched route: " . json_encode($route));
                // array_filter：過濾掉非字符串的值
                // ARRAY_FILTER_USE_KEY：使用鍵名作為回調函數的參數
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                // is_callable：檢查變量是否是合法的可調用函數
                if (!is_callable($route['handler'])) {
                    throw new \RuntimeException("Handler is not callable");
                }
                // 調用處理函數，並將動態參數作為參數傳入
                if (is_array($route['handler'])) {
                    $route['handler'][0]->{$route['handler'][1]}(...$params);
                } else {
                    // 如果處理函數是字符串，則直接調用
                    $route['handler'](...$params);
                }

                return;
            }
        }
        // 如果未找到匹配的路由，則返回 404 錯誤
        http_response_code(404);
        echo '路由未找到';
    }

    // group(): 設置當前的 URL 前綴，並執行回調函數、
    // callable：指定一個回調函數，可以是一個函數名（字符串）或一個匿名函數。
    public static function group($prefix, callable $callback)
    {
        // 保存當前的 URL 前綴，並將當前前綴設置為新的前綴
        $previousPrefix = self::$currentPrefix;
        // 將當前前綴和新前綴拼接
        self::$currentPrefix .= $prefix;
        // 調用回調函數
        $callback();
        // 還原當前前綴
        self::$currentPrefix = $previousPrefix;
    }
}

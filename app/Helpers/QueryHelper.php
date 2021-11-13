<?

namespace App\Helpers;


class QueryHelper
{
    /**
     * 
     * Filters query parameters to curl query
     * 
     * @param Array $filters
     * @return String
     */
    public function filters($filters)
    {
        $query = '';

        foreach ($filters as $key => $value) {
            $query .= '&' . $key . '=' . $value;
        }

        return $query;
    }

    /**
     * 
     * Returns the specified error with its error code
     * 
     * @param Number|String $http_code
     * @return Array
     * 
     */
    public function show_error($http_code)
    {
        $error_status = parse_ini_file(base_path() . '/error_status.ini');
        switch ($http_code) {
            case 200:  # OK
                return [];
            default:
                return
                    [
                        'error' => $http_code,
                        'status' => $error_status[$http_code]
                    ];
        }
    }
}

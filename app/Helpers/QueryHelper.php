<?

namespace App\Helpers;


class QueryHelper
{

    public function filters($filters)
    {
        $query = '';

        foreach ($filters as $key => $value) {
            $query .= '&' . $key . '=' . $value;
        }

        return $query;
    }
}

<?php


namespace Bitpiler\LaravelSharpspring\Tables;


class Projects extends AbstractTable
{
    /**
     * Index all projects.
     *
     * @param  int     $page
     * @param  string  $status
     * @return \Illuminate\Support\Collection
     */
    public function index($page = null, $status = null)
    {
        $url = 'projects.json';

        $projects = $this->client->get($url, [
            'query' => [
                'status' => $status,
                'page' => $page,
            ],
        ]);

        return $this->response($projects);
    }
}

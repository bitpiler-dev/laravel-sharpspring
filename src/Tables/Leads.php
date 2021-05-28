<?php


namespace Bitpiler\LaravelSharpspring\Tables;


class Leads extends AbstractTable
{
    const getLeads = 'getLeads';
    const getLeadsDateRange = 'getLeadsDateRange';
    const subscribeToLeadUpdates = 'subscribeToLeadUpdates';
    const updateLeads = 'updateLeads';
    const updateLeadsV2 = 'updateLeadsV2';

    public function find($id)
    {
        $document = $this->call('getLeads', [
            'id' => $id,
        ]);

        return $this->response($document);
    }

    public function get($data = [])
    {
        $limit = 500;
        $offset = 0;

        $payload = array_merge([
            'where' => [],
            'limit' => $limit,
            'offset' => $offset
        ], $data);

        $document = $this->call('getLeads', $payload);

        return $this->response($document);
    }

}

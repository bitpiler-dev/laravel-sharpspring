<?php


namespace Bitpiler\LaravelSharpspring\Table;


class Lead extends AbstractTable
{
    const getLeads = 'getLeads';
    const getLeadsDateRange = 'getLeadsDateRange';
    const subscribeToLeadUpdates = 'subscribeToLeadUpdates';
    const updateLeads = 'updateLeads';
    const updateLeadsV2 = 'updateLeadsV2';

    public function index($data = [])
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

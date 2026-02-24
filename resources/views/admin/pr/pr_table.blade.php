<style>
    .prTable {
        width:100%;
    }
</style>

@include('default.create-table', [ 'name' => $name,
  'columns' => [
    'PR No.',
    'Entity Name',
    'Fund Cluster',
    'Office',
    'Responsibility Code',
    'Purpose',
    'Creator',
    // 'Member',
    'Date Created',
    'Latest Update',
],
'creator' => $creator
])
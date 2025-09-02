<style>
    .prTable {
        width:100%;
    }
</style>

@include('default.create-table', [ 'name' => $name,
  'columns' => [
    'Entity Name',
    'Fund Cluster',
    'Office',
    'PR No.',
    'Responsibility Code',
    'Purpose',
    'Creator',
    'Member',
    'Date Created',
    'Latest Update',

  ]
])
<style>

</style>
{$paginator = $this->Paginator}
<div class="main-content col-md-12">
    <div class="row content-title title">
        <div class="col-md-12">
            {__('Category List')}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 quick-menu">
            <a class="btn btn-primary" href="/categories/add">Add Category</a>
        </div>
        <table class="table tbl-vertical-middle">
            <thead>
            <tr>
                <th width="160" class="text-center">{__('Category Name')}</th>
                <th class="text-center">{__('Progress')}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            {foreach $categories as $key => $category}
                <tr>
                    <td class="text-center"><strong><a
                                    href="/categories/view/{$category['Category']['id']}">{$category['Category']['name']}</a></strong>
                    </td>
                    <td class="text-center">
                        {__('You\'ve learned %d/%d',
                        $totalWordLearned[$category['Category']['id']],
                        $totalWordInCategory[$category['Category']['id']])
                        }
                    </td>
                    <td class="text-center"><a class="btn btn-primary">{__('Start')}</a></td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
    <div class="row text-center">
        <div class="col-md-12 paging">
            {$paginator->first({__('First')})}
            {($paginator->hasPrev()) ? $paginator->prev("<") : ''}
            {$paginator->numbers(['modulus' => 4, 'separator' => ''])}
            {($paginator->hasNext()) ? $paginator->next(">") : ''}
            {$paginator->last({__('Last')})}
        </div>
    </div>
</div>
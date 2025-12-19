<!-- Modern Data Table Component -->
<!-- Usage: @include('components.modern-table', ['headers' => ['ID', 'Name'], 'rows' => $data]) -->

<div class="table-container">
    @if(isset($showToolbar) && $showToolbar)
    <!-- Table Toolbar -->
    <div class="table-toolbar">
        @if(isset($searchField))
        <div class="table-search">
            <input 
                type="text" 
                id="tableSearch" 
                placeholder="🔍 Search {{ $searchField ?? 'data' }}..." 
                class="form-control"
            >
        </div>
        @endif
        
        <div class="table-actions">
            @if(isset($showExport) && $showExport)
            <button class="btn btn-outline-secondary" onclick="exportTable()">
                <i class="uil-download"></i> Export
            </button>
            @endif
        </div>
    </div>
    @endif

    <!-- Responsive Table Wrapper -->
    <div style="overflow-x: auto; border-radius: 0.5rem;">
        <table class="modern-table {{ isset($tableClass) ? $tableClass : '' }}">
            <!-- Table Header -->
            <thead>
                <tr>
                    @foreach($headers as $header)
                    <th class="sortable" data-field="{{ $header['field'] ?? strtolower(str_replace(' ', '_', $header['label'] ?? $header)) }}">
                        @if(is_array($header))
                            {{ $header['label'] ?? $header['field'] }}
                        @else
                            {{ $header }}
                        @endif
                    </th>
                    @endforeach
                    @if(isset($showActions) && $showActions)
                    <th style="width: 120px; text-align: center;">Actions</th>
                    @endif
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody>
                @if($rows && count($rows) > 0)
                    @foreach($rows as $row)
                    <tr>
                        @foreach($headers as $header)
                        <td data-label="{{ is_array($header) ? ($header['label'] ?? '') : $header }}">
                            @if(is_array($header) && isset($header['format']))
                                {!! $header['format']($row) !!}
                            @else
                                {{ $row[is_array($header) ? $header['field'] : strtolower(str_replace(' ', '_', $header))] ?? '-' }}
                            @endif
                        </td>
                        @endforeach

                        @if(isset($showActions) && $showActions)
                        <td data-label="Actions" style="text-align: center;">
                            <div class="action-buttons">
                                @if(isset($actions))
                                    @foreach($actions as $action)
                                    <a href="{{ $action['url']($row) }}" 
                                       class="action-btn btn-{{ $action['type'] ?? 'edit' }}" 
                                       title="{{ $action['label'] ?? '' }}">
                                        <i class="{{ $action['icon'] ?? 'uil-edit' }}"></i>
                                    </a>
                                    @endforeach
                                @endif
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                @else
                <tr class="empty-state">
                    <td colspan="{{ count($headers) + (isset($showActions) && $showActions ? 1 : 0) }}">
                        <i class="uil-inbox"></i>
                        <p>{{ $emptyMessage ?? 'No data available' }}</p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(isset($showPagination) && $showPagination && isset($paginator))
    <div class="table-pagination">
        <div class="table-pagination-info">
            Showing {{ $paginator->from ?? 1 }} to {{ $paginator->to ?? count($rows) }} of {{ $paginator->total ?? count($rows) }}
        </div>
        <div class="table-pagination-buttons">
            @if($paginator->onFirstPage())
            <button class="table-pagination-btn" disabled>← Previous</button>
            @else
            <a href="{{ $paginator->previousPageUrl() }}" class="table-pagination-btn">← Previous</a>
            @endif

            @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if($page == $paginator->currentPage())
                <button class="table-pagination-btn active">{{ $page }}</button>
                @else
                <a href="{{ $url }}" class="table-pagination-btn">{{ $page }}</a>
                @endif
            @endforeach

            @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="table-pagination-btn">Next →</a>
            @else
            <button class="table-pagination-btn" disabled>Next →</button>
            @endif
        </div>
    </div>
    @endif
</div>

<script>
// Table Search
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('tableSearch');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('.modern-table tbody tr:not(.empty-state)');
            
            tableRows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchTerm) ? '' : 'none';
            });
        });
    }
});

// Table Export to CSV
function exportTable() {
    const table = document.querySelector('.modern-table');
    let csv = [];
    
    // Get headers
    const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent);
    csv.push(headers.join(','));
    
    // Get rows
    const rows = table.querySelectorAll('tbody tr:not(.empty-state)');
    rows.forEach(row => {
        const cells = Array.from(row.querySelectorAll('td')).map(td => `"${td.textContent}"`);
        csv.push(cells.join(','));
    });
    
    // Download CSV
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'table_export_' + new Date().getTime() + '.csv';
    a.click();
    window.URL.revokeObjectURL(url);
}

// Column Sorting
document.querySelectorAll('.modern-table thead th.sortable').forEach(header => {
    header.addEventListener('click', function() {
        const field = this.dataset.field;
        const table = this.closest('table');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr:not(.empty-state)'));
        
        let isAsc = this.classList.contains('asc');
        
        // Remove sort classes from all headers
        table.querySelectorAll('thead th').forEach(th => th.classList.remove('asc', 'desc'));
        
        // Sort rows
        rows.sort((a, b) => {
            const aVal = a.querySelector(`td:nth-child(${Array.from(this.parentNode.children).indexOf(this) + 1})`).textContent.trim();
            const bVal = b.querySelector(`td:nth-child(${Array.from(this.parentNode.children).indexOf(this) + 1})`).textContent.trim();
            
            if (!isNaN(aVal) && !isNaN(bVal)) {
                return isAsc ? parseFloat(bVal) - parseFloat(aVal) : parseFloat(aVal) - parseFloat(bVal);
            }
            
            return isAsc ? bVal.localeCompare(aVal) : aVal.localeCompare(bVal);
        });
        
        // Reorder rows in DOM
        rows.forEach(row => tbody.appendChild(row));
        
        // Add sort class
        this.classList.add(isAsc ? 'desc' : 'asc');
    });
});
</script>

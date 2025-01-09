{{-- resources/views/partials/table.blade.php --}}
<div class="container mt-4">
    <div class="card">
        @if (isset($createRoute))
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ $createRoute }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            @foreach ($columns as $column)
                                <th>{{ $column }}</th>
                            @endforeach
    
                            @if (isset($editRoute) || isset($showRoute) || isset($deleteRoute))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                @foreach ($fields as $field)
                                    <td>
                                        @if (str_contains($field, '.'))
                                            @php
                                                $relation = explode('.', $field);
                                                $value = $item;
                                                foreach ($relation as $rel) {
                                                    $value = optional($value)->$rel;
                                                }
                                            
@endphp
                                            {{ $value }}
                                        @else
                                            @if ($field == 'description')
                                                {{ Str::limit($item->$field, 25) }}
                                            @elseif ($field == 'cost')
                                                {{ $item->formatted_cost }}
                                            @else
                                                {{ $item->$field }}
                                            @endif
                                        @endif
                                    </td>
                                @endforeach
    
                                @if (isset($editRoute) || isset($showRoute) || isset($deleteRoute))
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            @if (isset($editRoute))
                                                <a href="{{ route($editRoute, $item->id) }}" class="btn btn-warning btn-sm mr-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            @endif
    
                                            @if (isset($showRoute))
                                                <a href="{{ route($showRoute, $item->id) }}" class="btn btn-info btn-sm mr-1">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            @endif
    
                                            @if (isset($deleteRoute))
                                                <form action="{{ route($deleteRoute, $item->id) }}" method="post"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($columns) + (isset($editRoute) || isset($showRoute) || isset($deleteRoute) ? 1 : 0) }}" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

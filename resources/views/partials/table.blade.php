{{-- resources/views/partials/table.blade.php --}}
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <a href="{{ $createRoute }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        @foreach ($columns as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                        <th>Aksi</th>
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
                                            $value = optional($item->{$relation[0]})->{$relation[1]};
                                        @endphp
                                        {{ $value }}
                                    @else
                                        @if ($field == 'description')
                                            {{ Str::limit($item->$field, 25) }}
                                        @else
                                            {{ $item->$field }}
                                        @endif
                                    @endif

                                </td>
                            @endforeach
                            <td>
                                @if ($editRoute)
                                    <a href="{{ route($editRoute, $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                @endif
                                <a href="{{ route($showRoute, $item->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                @if ($deleteRoute)
                                    <form action="{{ route($deleteRoute, $item->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($items->isEmpty())
                <p class="text-center">Tidak ada data</p>
            @endif
        </div>
    </div>
</div>

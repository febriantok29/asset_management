<form
                action="{{ $route }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan kode atau nama" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ $route }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
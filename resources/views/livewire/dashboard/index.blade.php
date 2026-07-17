<div class="mx-auto flex w-full max-w-7xl flex-col gap-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
        <div class="flex flex-col gap-4 lg:grid lg:grid-cols-2 lg:items-start lg:gap-6">
            <div class="min-w-0">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Sistem Pemesanan</p>
                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">Halo, Lutfiatun Hafizah</h1>
                <p class="mt-2 text-sm text-slate-600">Selamat datang di sistem pemesanan tiket bioskop online.</p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center lg:justify-end">
                <div class="w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-4 py-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Ringkasan Hari Ini</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($summaryItems as $item)
                            <div class="flex min-w-[132px] items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 shadow-sm">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full {{ $item['accent'] }}">
                                    {!! $item['icon'] !!}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[11px] font-medium text-slate-500">{{ $item['label'] }}</p>
                                    <p class="truncate text-sm font-semibold text-slate-900">{{ $item['value'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Daftar Film</h2>
                <p class="mt-1 text-sm text-slate-500">Film terbaru yang tersedia di menu movies.</p>
            </div>
            <a href="{{ route('movies.index') }}" class="text-sm font-medium text-sky-600 transition hover:text-sky-700">
                Lihat semua →
            </a>
        </div>

        <div class="mt-5 flex gap-4 overflow-x-auto pb-2">
            @forelse ($latestMovies as $movie)
                <div class="min-w-[160px] max-w-[160px] flex-shrink-0 rounded-2xl border border-slate-200 bg-slate-50/70 p-2 transition hover:-translate-y-0.5 hover:shadow-sm">
                    <div class="flex h-20 items-center justify-center overflow-hidden rounded-xl border border-slate-200 bg-slate-100">
                        @if (!empty($movie['poster_url']))
                            <img src="{{ $movie['poster_url'] }}" alt="{{ $movie['title'] }}" class="h-full w-full object-cover object-center" />
                        @else
                            <span class="text-lg font-semibold text-slate-600">{{ $movie['initial'] }}</span>
                        @endif
                    </div>
                    <div class="mt-3">
                        <p class="truncate font-semibold text-slate-900">{{ $movie['title'] }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $movie['genre'] }} • {{ $movie['duration'] }} • {{ $movie['year'] }}</p>
                    </div>
                </div>
            @empty
                <div class="w-full rounded-xl border border-dashed border-slate-200 bg-slate-50 px-4 py-6 text-center text-sm text-slate-500">
                    Belum ada data film.
                </div>
            @endforelse
        </div>
    </div>
</div>

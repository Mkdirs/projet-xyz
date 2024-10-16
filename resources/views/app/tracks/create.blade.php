<x-app title="Contribuer">

    <main class="container-wide space-y-8">
        <section>
            <h1>
                Contribuer <small>{{$week->name}}</small>
            </h1>

            {{-- If user cannot create tracks --}}
            {{-- <div>
                <p>Vous ne pouvez plus contribuer pour cette semaine.</p>
            </div> --}}

            <form method="post" action="{{route('track.contribute.create', ['week' => $week])}}" class="track-form space-y-4">
                <div>
                    <label for="title">Titre</label>
                    <input name="title" id="title" class="w-large" type="text" value="" placeholder="nom du titre" autocomplete="off" autofocus>
                </div>

                @error('title')
                <p class="error-message">{{ $message }}</p>
                @enderror

                <div>
                    <label for="artist">Artiste</label>
                    <input name="artist" id="artist" class="w-medium" type="text" value="" placeholder="nom de l'artiste" autocomplete="off">
                </div>

                @error('artist')
                <p class="error-message">{{ $message }}</p>
                @enderror

                <div>
                    <label for="url">Lien d'écoute</label>
                    <input name="url" id="url" class="w-medium" type="text" value="" placeholder="lien youtube ou soundcloud" autocomplete="off">
                </div>

                @error('url')
                <p class="error-message">{{ $message }}</p>
                @enderror

                <div class="submit">
                    @csrf
                    <button type="submit" class="primary">Envoyer</button>
                    <div>{{ trans_choice('tracks.remaining', 2) }}</div>
                </div>
            </form>
        </section>
    </main>

</x-app>

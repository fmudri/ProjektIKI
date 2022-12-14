<x-layout>
    <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
            Uredi oglas
            </h2>
            <p class="mb-4">Uredi: {{$listing->title}}</p>
        </header>
                    {{--Kada god imamo file u formi, mora se dodati enctype--}}
                        <form method="POST" action="/listings/{{$listing->id}}" enctype="multipart/form-data">
                            <!--crsf sprječava cross-site scripting attacks-->
                            @csrf
                            @method('PUT')
                            <div class="mb-6">
                                <label
                                    for="company"
                                    class="inline-block text-lg mb-2"
                                    >Naziv tvrtke</label
                                >
                                {{--value old 'company' omogućava da ukoliko dodđe do greške prilikom unosa, tekst ostane zapisan nakon reloada stranice--}}
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="company" value="{{$listing->company}}"
                                />
    
                                {{--Ovdje se događa što god u formi faila
                                    "Ako nešto ne uspije, napravi ovo--}}
                                @error('company')
                                    <p class="text-red-500 text-xs class=mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <label for="title" class="inline-block text-lg mb-2"
                                    >Naziv radnog mjesta</label
                                >
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="title"
                                    placeholder="Example: Senior Laravel Developer" value="{{$listing->title}}"
                                />
                                @error('title')
                                    <p class="text-red-500 text-xs class=mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <label
                                    for="location"
                                    class="inline-block text-lg mb-2"
                                    >Mjesto obavljanja posla</label
                                >
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="location"
                                    placeholder="Example: Remote, Boston MA, etc" value="{{$listing->location}}"
                                />
                                @error('location')
                                    <p class="text-red-500 text-xs class=mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <label for="email" class="inline-block text-lg mb-2"
                                    >Kontakt Email</label
                                >
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="email" value="{{$listing->email}}"
                                />
                                @error('email')
                                    <p class="text-red-500 text-xs class=mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <label
                                    for="website"
                                    class="inline-block text-lg mb-2"
                                >
                                    Web stranica tvrtke
                                </label>
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="website" value="{{$listing->webiste}}"
                                />
                                @error('website')
                                    <p class="text-red-500 text-xs class=mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <label for="tags" class="inline-block text-lg mb-2">
                                    Oznake (Odvojite zarezom)
                                </label>
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="tags"
                                    placeholder="Example: Laravel, Backend, Postgres, etc" value="{{$listing->tags}}"
                                />
                                @error('tags')
                                    <p class="text-red-500 text-xs class=mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <label for="logo" class="inline-block text-lg mb-2">
                                    Logo tvrtke
                                </label>
                                <input
                                    type="file"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="logo"
                                />
                                <img
                            class="w-48 mr-6 mb-6"
                            src="{{$listing->logo ? asset('storage/'. $listing->logo) : asset('/images/no-image.png')}}"
                            alt=""
                        />
                                @error('logo')
                                    <p class="text-red-500 text-xs class=mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <label
                                    for="description"
                                    class="inline-block text-lg mb-2"
                                >
                                    Opis posla
                                </label>
                                <textarea
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="description"
                                    rows="10"
                                    placeholder="Include tasks, requirements, salary, etc" value="{{$listing->description}}"
                                ></textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs class=mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <button
                                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                                    Podnesi promjene
                                </button>
    
                                <a href="/" class="text-black ml-4"> Povratak </a>
                            </div>
                        </form>
                    </div>
                </x-layout>
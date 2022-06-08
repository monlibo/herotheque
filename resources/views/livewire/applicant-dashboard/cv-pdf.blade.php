<div>
    <button wire:click="generate">Générer</button>
    <div style="background-color: red" class="w-full text-center font-bold text-lg mb-10">Curriculum Vitae</div>
    <div class="flex flex-row justify-center h-auto m-auto space-x-[30px]">
        <div class="w-1/2 flex flex-row justify-center py-10">
            <div class="h-full flex flex-col space-y-5 w-full items-center ">
                @if ($user->profile_photo_path)
                    <div class="w-[180px] max-h-[200px]  bg-[gray]  overflow-hidden">
                        <img src="{{ storage_path(Auth::user()->profile_photo_path) }}" class="h-full" alt="">
                    </div>
                @endif
                <div class="flex flex-col space-y-4 w-full items-center px-4">
                    <div class="text-[20px]">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>
                    <div class="w-full text-center">{{ Auth::user()->profile->short_bio }}</div>
                </div>

                <div class="flex flex-col space-y-2 w-full items-center px-4">
                    <div class="text-[16px] font-bold text-left w-full">CONTACTS</div>
                    <ul class="text-left w-full">
                        <li>Téléphone : +229 {{ Auth::user()->phone_number }}</li>
                        <li>Whatsapp : +229 65 32 35 75</li>
                        <li>Email : {{ Auth::user()->email }}</li>
                        @if (Auth::user()->city_address)
                            <li>Adresse : {{ App\Models\City::find(Auth::user()->city_address)->name }},
                                {{ App\Models\State::find(Auth::user()->department_address)->name }}</li>
                        @endif
                    </ul>
                </div>

                <div class="flex flex-col space-y-2 w-full items-center px-4">

                    <div class="text-[16px] font-bold text-left w-full">COMPETENCES</div>
                    @foreach ($skills as $skill)
                        <div class="text-left w-full text-[14px] ml-10">
                            <strong>{{ $skill['name'] }}</strong> <br>
                            <span>{{ $skill['level'] }}</span>
                        </div>
                    @endforeach


                </div>

                <div class="flex flex-col space-y-2 w-full items-center px-4">

                    <div class="text-[16px] font-bold text-left w-full">LANGUES</div>
                    @foreach ($languages as $language)
                        <div class="text-left w-full text-[14px] ml-10">
                            <strong>{{ $language['name'] }}</strong> <br>
                            <span>{{ $language['level'] }}</span>
                        </div>
                    @endforeach


                </div>



            </div>
        </div>





        <div class="border-l-2 border-gray-400 w-1/2 flex flex-row justify-center py-10 px-4">
            <div class="flex flex-col  space-y-7 w-full   ">
                @if ($user->profile->bio && $user->profile->bio !== '<p><br></p>')
                    <div class="flex flex-col space-y-2 w-full items-center ">
                        <div class="text-[16px] font-bold text-left w-full h-[40px] flex flex-row items-center">
                            Biographie</div>
                        <div class="w-full bio-container">
                            {!! $user->profile->bio !!}
                        </div>
                    </div>
                @endif

                <div class="flex flex-col space-y-2 w-full items-center ">
                    <div class="text-[16px] font-bold text-left w-full h-[40px] flex flex-row items-center">
                        FORMATIONS</div>
                    <ul class="flex flex-col text-left w-full space-y-4 pl-4">
                        @foreach ($trainings as $training)
                            <li><strong>{{ $training->name }}</strong> <br>
                                {{ $training->institut }} , {{ $training->city }}, {{ $training->country }}
                                <br>
                                de <span>{{ $training->date_start }}</span> à
                                <span>{{ $training->date_end }}</span>
                                <span>{{ $training->description }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>



                <div class="flex flex-col space-y-2 w-full items-center ">
                    <div class="text-[16px] font-bold text-left w-full   h-[40px] flex flex-row items-center">
                        EXPERIENCES PROFESSIONNELLES</div>
                    <ul class="flex flex-col text-left w-full  space-y-4 pl-4">
                        @foreach ($experiences as $experience)
                            <li><strong>{{ $experience->position_occuped }}</strong> <br>
                                {{ $experience->company }} , {{ $experience->city }},
                                {{ $experience->country }} <br>
                                de <span>{{ $experience->date_start }}</span> à
                                <span>{{ $experience->date_end }}</span>
                                <span>{{ $experience->description }}</span>
                            </li>
                        @endforeach

                    </ul>
                </div>









            </div>
        </div>

    </div>
    <div class="w-full text-center  text-black text-[12px] font-bold mt-10 ">
        Généré le {{ now() }} par <span class="text-blue-500"> Emploitheque.com </span>
    </div>
</div>

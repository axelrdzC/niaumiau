<x-app-layout>

    <div class="py-10 flex flex-col w-full gap-8">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex gap-7 mb-5">
            <button onclick="openSidebar()" class="text-center flex flex-col items-center transition-transform duration-200 hover:scale-110">
                <img src="/img/ness.png" alt="" class="w-12 h-12">
                <div class="mt-2">Subir prendas</div>
            </button>
            <a href="/outfits" class="text-center flex flex-col items-center">
                <img src="/img/phone.png" alt="" class="w-12 h-12">
                <div class="mt-2">Buscar niauianos</div>
            </a>
            <a href="/outfits" class="text-center flex flex-col items-center">
                <img src="/img/ness.png" alt="" class="w-12 h-12">
                <div class="mt-2">Ver mis stats</div>
            </a>
        </div>
        <div class="max-w-8xl mx-auto w-full sm:px-6 lg:px-8 flex gap-2">
            <!-- recomendaciones -->
            <div class="w-full flex bg-[#9471B7] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-xl text-gray-100">
                    <div class="">
                        No sabes que ponerte hoy?
                    </div>
                    <span class="font-pixelify text-2xl">PRUEBA UNA DE NUESTRAS RECOMENDACIONES!</span>
                </div>
            </div>
            <!-- clima -->
            <div class="w-full flex font-michroma bg-gradient-to-l from-[#e2f1f1] to-[#afc9e3] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 me-4 text-white">
                    <div> Ciudad Victoria, Tamaulipas </div>
                    <div class=" text-6xl"> 27° </div>
                    <div class="pt-2"> Despejado </div>
                    <div class=""> 31°/ 14° </div>
                </div>
                <div class="p-6 flex flex-1 flex-col gap-2">
                    <div class="bg-white flex w-full p-2 px-4">
                        Manana <span class="flex-1 w-full text-right text-gray-400">5° / 31°</span>
                    </div>
                    <div class="bg-white flex w-full p-2 px-4">
                        Jueves <span class="flex-1 w-full text-right text-gray-400">5° / 31°</span>
                    </div>
                    <div class="bg-white flex w-full p-2 px-4">
                        Viernes <span class="flex-1 w-full text-right text-gray-400">5° / 31°</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="sm:px-6 lg:px-8 flex gap-2 flex-col">
            <h1 class="font-pixelify text-3xl text-gray-700">Los outfits del mes</h1>
            <div class="flex gap-2">
                <!-- calenadriop -->
                <div id="calendar" class="shadow-md w-2/5 bg-white">
                    <div class="flex items-center justify-between p-2 bg-gray-200 border-b border-gray-300">
                      <button id="prevMonth"><</button>
                      <span id="monthYear" class="text-xl"></span>
                      <button id="nextMonth">></button>
                    </div>
                    <div class="flex flex-col p-2 py-4 text-center">
                      <div class="day-names">
                        <span>D</span>
                        <span>L</span>
                        <span>M</span>
                        <span>X</span>
                        <span>J</span>
                        <span>V</span>
                        <span>S</span>
                      </div>
                      <div id="days" class="days"></div>
                    </div>
                </div>
                <!-- un preview -->
                <div class="container flex gap-2">
                    @foreach ($outfits as $outfit)
                    <x-item-preview onclick="openModal('seeoutfitModal', '/outfits/{{$outfit->id}}', null, loadOutfitData)">
                        <div class="font-semibold text-lg text-center"> {{ $outfit->name }} </div>
                        <div class="flex justify-center gap-2 mt-2">
                            @foreach ($outfit->prendas as $prenda)
                                <img src="{{ asset('storage/' . $prenda->imagen) }}" 
                                    alt="{{ $prenda->nombre }}" 
                                    class="w-20 h-20 object-cover">
                            @endforeach
                        </div>
                    </x-item-preview>        
                    @endforeach
                </div>
            </div>
              
        </div>

        @include('modales.item-add')
        @include('modales.preview-outfit')

    </div>
</x-app-layout>

<script>
    const daysContainer = document.getElementById('days');
    const monthYear = document.getElementById('monthYear');
    const prevMonthButton = document.getElementById('prevMonth');
    const nextMonthButton = document.getElementById('nextMonth');
  
    let currentDate = new Date();
  
    function renderCalendar() {
      const month = currentDate.getMonth();
      const year = currentDate.getFullYear();
  
      monthYear.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${year}`;
  
      const firstDayOfMonth = new Date(year, month, 1);
      const lastDayOfMonth = new Date(year, month + 1, 0);
      const totalDaysInMonth = lastDayOfMonth.getDate();
      const firstDayWeekday = firstDayOfMonth.getDay();
  
      daysContainer.innerHTML = '';
  
      // Crear espacios vacíos antes del primer día del mes
      for (let i = 0; i < firstDayWeekday; i++) {
        const emptyCell = document.createElement('div');
        emptyCell.classList.add('day', 'inactive');
        daysContainer.appendChild(emptyCell);
      }
  
      // Crear los días del mes
      for (let day = 1; day <= totalDaysInMonth; day++) {
        const dayCell = document.createElement('div');
        dayCell.classList.add('day');
        dayCell.textContent = day;
        daysContainer.appendChild(dayCell);
      }
    }
  
    prevMonthButton.addEventListener('click', () => {
      currentDate.setMonth(currentDate.getMonth() - 1);
      renderCalendar();
    });
  
    nextMonthButton.addEventListener('click', () => {
      currentDate.setMonth(currentDate.getMonth() + 1);
      renderCalendar();
    });
  
    // Inicializar el calendario
    renderCalendar();
</script>
  

<x-app-layout>
@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
        📅 Installation Calendar
    </h2>

    <div class="flex justify-between mb-4">
        <button id="prevMonth" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">⬅️ Previous</button>
        <h3 id="monthYear" class="text-xl font-semibold"></h3>
        <button id="nextMonth" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Next ➡️</button>
    </div>

    <div id="calendar" class="grid grid-cols-7 gap-2 text-center">
        <!-- Calendar will be inserted here by JavaScript -->
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', async () => {
    const calendar = document.getElementById('calendar');
    const monthYear = document.getElementById('monthYear');
    const prevBtn = document.getElementById('prevMonth');
    const nextBtn = document.getElementById('nextMonth');

    let currentDate = new Date();
    let installations = [];

    async function fetchInstallations() {
        const response = await fetch("{{ route('solar.installation.dates') }}");
        installations = await response.json();

        // Format installation_date
        installations = installations.map(inst => ({
            ...inst,
            installation_date: new Date(inst.installation_date).toISOString().slice(0, 10)
        }));
    }

    function renderCalendar() {
        calendar.innerHTML = ''; // Clear old calendar
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        monthYear.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Empty slots before first day
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            calendar.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

            const dayCell = document.createElement('div');
            dayCell.className = 'p-3 border rounded shadow-sm';

            if (installations.some(inst => inst.installation_date === dateStr)) {
                dayCell.classList.add('bg-green-200', 'cursor-pointer', 'hover:bg-green-300');
                const install = installations.find(inst => inst.installation_date === dateStr);
                dayCell.title = install.customer_name;
            }

            dayCell.textContent = day;
            calendar.appendChild(dayCell);
        }
    }

    prevBtn.addEventListener('click', (e) => {
        e.preventDefault(); // 🛑 Stop the page from refreshing
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextBtn.addEventListener('click', (e) => {
        e.preventDefault(); // 🛑 Stop the page from refreshing
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });


    await fetchInstallations();
    renderCalendar();
});
</script>
@endsection
</x-app-layout>
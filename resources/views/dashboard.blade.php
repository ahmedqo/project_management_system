@extends('communs.base')
@section('title', 'Dashboard')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Dashboard
            </h1>
            <div class="w-max flex items-center gap-2">
                <a href="#"
                    class="w-10 h-10 flex items-center justify-center rounded-full text-white bg-primary outline-none hover:bg-light focus:bg-light">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M32.3 42.35V23.3q0-1.1-.525-2.225T30.45 19.3l-10.2-7.2V8.6q.3-1.2 1.325-2.075Q22.6 5.65 24.05 5.65H42.1q1.8 0 3.2 1.35 1.4 1.35 1.4 3.2v27.6q0 1.9-1.4 3.225-1.4 1.325-3.2 1.325Zm2.8-8.6h2.85V30.9H35.1Zm0-8.4h2.85V22.5H35.1Zm0-8.5h2.85V14H35.1ZM1.3 40.05V24.6q0-1.1.475-2.075.475-.975 1.425-1.675l9.45-6.65q1.25-.85 2.65-.85t2.65.85l9.35 6.65q.85.7 1.35 1.675.5.975.5 2.075v15.45q0 1.05-.65 1.675t-1.65.625h-7.6v-11.9h-7.9v11.9h-7.8q-.9 0-1.575-.625Q1.3 41.1 1.3 40.05Z" />
                    </svg>
                </a>
                <a href="#"
                    class="w-10 h-10 flex items-center justify-center rounded-full text-white bg-primary outline-none hover:bg-light focus:bg-light">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M32.3 42.35V23.3q0-1.1-.525-2.225T30.45 19.3l-10.2-7.2V8.6q.3-1.2 1.325-2.075Q22.6 5.65 24.05 5.65H42.1q1.8 0 3.2 1.35 1.4 1.35 1.4 3.2v27.6q0 1.9-1.4 3.225-1.4 1.325-3.2 1.325Zm2.8-8.6h2.85V30.9H35.1Zm0-8.4h2.85V22.5H35.1Zm0-8.5h2.85V14H35.1ZM1.3 40.05V24.6q0-1.1.475-2.075.475-.975 1.425-1.675l9.45-6.65q1.25-.85 2.65-.85t2.65.85l9.35 6.65q.85.7 1.35 1.675.5.975.5 2.075v15.45q0 1.05-.65 1.675t-1.65.625h-7.6v-11.9h-7.9v11.9h-7.8q-.9 0-1.575-.625Q1.3 41.1 1.3 40.05Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-4 items-start">
        <div class="w-full lg:w-4/12 h-full">
            <div class="w-full h-full flex flex-col">
                <h2 class="text-gray-900 font-bold text-lg lg:text-xl mb-1">Prodactivity</h2>
                <div class="w-full h-full relative bg-white p-4 rounded-lg flex">
                    <div class="w-full m-auto aspect-square lg:aspect-auto">
                        <canvas id="pie" class="w-full aspect-square"></canvas>
                    </div>
                    <span id="data"
                        class="font-black text-gray-900 text-3xl absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></span>
                </div>
            </div>
        </div>
        <div class="w-full flex-1 h-full">
            <div class="w-full h-full flex flex-col">
                <h2 class="text-gray-900 font-bold text-lg lg:text-xl mb-1">Week tasks</h2>
                <div class="w-full bg-white p-4 rounded-lg">
                    <canvas id="chart" class="w-full flex-1"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        const vals = Object.values({!! json_encode($progress) !!});
        data.innerHTML = ((vals[0] / (vals[0] + vals[1]) || 0) * 100).toFixed(2) + "%";
        new Chart("pie", {
            type: "doughnut",
            data: {
                labels: Object.keys({!! json_encode($progress) !!}),
                datasets: [{
                    backgroundColor: ["#ff3000", "#f3f4f6"],
                    data: Object.values({!! json_encode($progress) !!})
                }]
            },
            options: {
                legend: false,
                tooltips: false,
                maintainAspectRatio: false
            }
        });

        new Chart("chart", {
            type: "line",
            data: {
                labels: Object.keys({!! json_encode($days) !!}),
                datasets: [{
                    borderColor: theme.primary,
                    backgroundColor: theme.primary,
                    data: Object.values({!! json_encode($days) !!})
                }]
            },
            options: {
                legend: {
                    display: false
                },
            }
        });
    </script>
@endsection

<div class="-mt-6">
    <header class="px-4 lg:px-16 pt-6 pb-20 flex justify-between items-center bg-grey-100">
        <div class="flex items-center animate__animated animate__pulse animate__infinite">
            <img src="{{ asset('storage/noimage.jpg') }}" alt="">
            <span>Updating live</span>
        </div>
    </header>


    <div class="-mt-12 flex flex-col justify-center items-center">
        <div class="flex flex-col justify-center items-center">
            <img src="{{ asset('storage/noimage.jpg') }}" alt="">
            <h2 class="mt-2 text-xl font-semibold">Clovon</h2>
        </div>

        <div class="mt-16 flex flex-col items-center">
            <div wire:poll="fetchData">
                <div class="animate__animated animate__pulse animate__infinite">
                    <span class="text-6xl font-semibold">{{ $recentSubscribers }}</span>
                </div>
            </div>
            <span class="mt-3 text-xl text-gray-700">Subscribers</span>
        </div>

        <div class="w-full" style="height: 50%">
            <div class="px-10" id="chart"></div>
        </div>
    </div>
</div>




@push('js')
    <script>
        var options = {
            chart: {
                type: 'line',
                height: '250px',
                animation: {
                    enabled: false
                }
            },
            series: [{
                name: 'Subscribers',
                data: @json($subscribers)
            }],
            xaxis: {
                // categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
                categories: @json($days)
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();

        document.addEventListener('livewire:load', () => {
            @this.on('refreshChart', (chartData) => {
                chart.updateSeries([{
                    data: chartData.seriesData
                }])
            });
        });
    </script>
@endpush

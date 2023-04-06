<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> &copy; DISDUKCAPIL KAB. BATU BARA
            </div>
            <!-- <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by <a
                                    href="https://1.envato.market/themesdesign" target="_blank">Themesdesign</a>
                            </div>
                        </div> -->
        </div>
    </div>
</footer>
<!-- end Footer -->
</div>
</div>
</body>

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="{{ asset('/') }}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- apexcharts -->
<script src="{{ asset('/') }}assets/libs/apexcharts/apexcharts.min.js"></script>

<script>
    function getChartColorsArray(e) {
        if (null !== document.getElementById(e)) {
            var r = document.getElementById(e).getAttribute("data-colors");
            return (r = JSON.parse(r)).map(function(e) {
                var r = e.replace(" ", "");
                if (-1 === r.indexOf(",")) {
                    var t = getComputedStyle(document.documentElement).getPropertyValue(r);
                    return t || r
                }
                var a = e.split(",");
                return 2 != a.length ? r : "rgba(" + getComputedStyle(document.documentElement)
                    .getPropertyValue(a[0]) + "," + a[1] + ")"
            })
        }
    }
    var chartBarColors = getChartColorsArray("mini-1"),
        options = {
            chart: {
                type: "line",
                width: 130,
                height: 55,
                sparkline: {
                    enabled: !0
                }
            }
        };
    (chart = new ApexCharts(document.querySelector("#column_chart"), options)).render();
    // Mengambil jumlah data dari variabel PHP
    var pendingCount = {{ $pendingCount }};
    var selesaiCount = {{ $selesaiCount }};
    var ditolakCount = {{ $ditolakCount }};

    // Mengganti data series dengan jumlah data
    options = {
        chart: {
            height: 287,
            type: "donut"
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "75%"
                }
            }
        },
        dataLabels: {
            enabled: !1
        },
        series: [pendingCount, selesaiCount, ditolakCount],
        labels: ["Diproses", "Selesai", "Ditolak"],
        colors: chartBarColors = getChartColorsArray("chart-donut"),
        legend: {
            show: !1
        }
    };
    (chart = new ApexCharts(document.querySelector("#chart-donut"), options)).render();
</script>

<script src="{{ asset('/') }}assets/js/app.js"></script>

</html>

<div class="chart-container">
    <div class="pie-chart-container">
      <canvas id="engage_seleccion"></canvas>
    </div>
</div>
<script>
    $(function(){
        let cData = JSON.parse(`<?php echo $engage_seleccion; ?>`);
        let ctx = $("#engage_seleccion");
    
        let data = {
          labels: cData.label,
          datasets: [
            {
              label: "% efectividad",
              data: cData.data,
              borderColor: [
                "#5A9AD4",
              ],
              borderWidth: [1]
            }
          ]
        };
    
        let options = {
          responsive: true,
          title: {
            display: true,
            position: "top",
            text: "Efectividad Selección",
            fontSize: 18,
            class: 'header-title',
            fontColor: "#111"
          },
          legend: {
            display: true,
            position: "bottom",
            labels: {
              fontColor: "#333",
              fontSize: 16
            }
          },
          scales: {
                y: {
                    beginAtZero: true
                }
            },
        };
  
        let chart1 = new Chart(ctx, {
          type: "line",
          data: data,
          options: options
        });
    
    });
</script>
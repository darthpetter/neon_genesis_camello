<div class="chart-container">
    <div class="pie-chart-container">
      <canvas id="asignaciones_por_labor"></canvas>
    </div>
</div>
<script>
    $(function(){
        let cData = JSON.parse(`<?php echo $asignaciones_por_labor; ?>`);
        let ctx = $("#asignaciones_por_labor");
    
        let data = {
          labels: cData.label,
          datasets: [
            {
              data: cData.data,
              backgroundColor: [
                "#5A9AD4",
                "#D4BA44",
                "#4ED4CD",
                "#D4916E",
                "#6563D4",
              ],
              borderColor: [
                "#5A9AD4",
                "#D4BA44",
                "#4ED4CD",
                "#D4916E",
                "#6563D4",
              ],
              borderWidth: [1, 1, 1, 1, 1,1,1]
            }
          ]
        };
    
        let options = {
          responsive: true,
          title: {
            display: true,
            position: "top",
            text: "Proporcion de Areas de Labor más postuladas",
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
          type: "pie",
          data: data,
          options: options
        });
    
    });
</script>
<div class="chart-container">
    <div class="pie-chart-container">
      <canvas id="engage_postulaciones"></canvas>
    </div>
</div>
<script>
    $(function(){
        let cData = JSON.parse(`<?php echo $engage_postulaciones; ?>`);
        let ctx = $("#engage_postulaciones");
    
        let data = {
          labels: cData.label,
          datasets: [
            {
              label: "Users Count",
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
            text: "Usuarios Registrados por ROL",
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
          }
        };
  
        let chart1 = new Chart(ctx, {
          type: "bar",
          data: data,
          options: options
        });
    
    });
</script>
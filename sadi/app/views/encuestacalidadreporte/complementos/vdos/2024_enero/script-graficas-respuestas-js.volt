<script>
  function fnImprimirReporteConHtml() {
    Swal.fire({
      title: "Creando reporte de respuestas PDF",
      onBeforeOpen: () => {
        Swal.showLoading();
      },
    });

    html2canvas(document.querySelector("#listado-graficas-respuestas"))
      .then((canvas) => {
        let base64image = canvas.toDataURL("image/png");
        let pdf = new jsPDF("p", "px", [2000, 2500]);
        pdf.addImage(base64image, "PNG", 0, 0, 2000, 2500);
        pdf.setFontSize(22);
        pdf.text(20, 20, "Hello world!");
        pdf.setProperties({
          title: "Reporte respuestas",
          subject: "Encuesta servicio calidad",
          author: "SIPS RH",
          keywords: "SIPSRH",
          creator: "SIPSRH",
        });

        let nombre_extra = $("#enc_fecha-reporte").val();

        pdf.save("reporte-estadisticas-respuestas-" + nombre_extra + ".pdf");
      })
      .then(() => {})
      .finally(() => {
        Swal.close();

        Swal.fire({
          icon: "success",
          title: "¡PDF generado!",
          text: "El archivo ha sido generado exitosamente.",
        }).then(() => {});
      });
  }
  function fnLimipiarGraficasReporteRespuestasCalidad() {
    let graficasLimpiar = document.querySelectorAll(
      ".pie-chart-reporte-respuestas"
    );
    // Recorrer todos los elementos y limpiar su contenido HTML
    graficasLimpiar.forEach(function (elemento) {
      elemento.innerHTML = "";
    });

    let textosLimpiar = document.querySelectorAll(".texto-graficas");
    // Recorrer todos los elementos y limpiar su contenido HTML
    textosLimpiar.forEach(function (elemento) {
      elemento.innerHTML = "";
    });
  }
  function consultar_estadisticas_respuestas(form_id, tipo_grafica = 0) {
    let url_enviar =
      "<?php echo $this->url->get('encuestacalidadreporte/ajax_get_data_respuestas_porcentaje_estadisiticas/') ?>";
    let inv_id = $("#inv_id-reporte").val();
    $.ajax({
      type: "POST",
      url: url_enviar + inv_id,
      data: $(`#${form_id}`).serialize(),
      success: function (res) {       
        let data_cabezera = res["detalles-encuesta"];
        $("#listado-graficas-respuestas").empty("");

        if (res["contador-respuestas"] != 0) {
          //cabcezara reporte
          if (data_cabezera["estatus_data"] == "-2") {
            $("#listado-graficas-respuestas").hide();
            $("#listado-graficas-respuestas-container").hide();

            
            return false;
          }
          $("#listado-graficas-respuestas").show("slow");
          $("#listado-graficas-respuestas-container").show();

          $("#texto-cabezera-reporte-respuesta").html(
            `
                                <div class=" row d-flex justify-content-end">
                                    <button onclick="CargarTipoGrafico('${form_id}',0)" class="btn btn-info bg-del-sistema" style="margin:5px;">
                                    <i class="mdi mdi-chart-arc mdi-18px btn-icon text-white"></i>

                                    </button>
                                    <button onclick="CargarTipoGrafico('${form_id}',1)"  class="btn btn-info bg-del-sistema" style="margin:5px 20px 5px 5px ; ">
                                    <i class="mdi mdi-chart-bar mdi-18px btn-icon text-white"></i>

                                    </button>
                                </div>
                                <h5>Detalle de evaluaciones</h5>
                                    <p>
                                    Se realizaron ${data_cabezera["total_encuestas_contestadas"]} encuestas de un total de<span clas="text-uppercase" >&nbsp;${data_cabezera["total_eses"]}&nbsp;</span>estudios, evaluando a los investigadores &nbsp;${data_cabezera["fecha_formato_texto"]}&nbsp;con la finalidad de medir el desempeño, la satisfacción de los candidatos, el tiempo de respuesta e identificar las áreas de oportunidad en el servicio prestado.
                                    </p>
                                `
          );

          if (tipo_grafica == "0") {
            generarGraficasPastel(res);
          }
          // console.error(res["todas-preguntas-estadisticas"]);
          if (tipo_grafica == "1") {
            generarGraficasBarras(res);
          }
          // console.log(tipo_grafica);

          //pregunta 17 fin
        } else {
          $("#listado-graficas-respuestas").hide();

          alertify.alert("SIN DATOS", "No hay datos para consultar");
        }
      },
      error: function (data) {
        alertify.alert(
          "ERROR",
          "No se pudieron cargar los datos vuelve a intentar de nuevo." +
            data.responseText
        );
      },
    });
  }
  function createChartContainer(questionText, chartId) {
    // Crear el HTML dinámicamente con comillas francesas
    let htmlContent = `
        <div class="col-12 col-md-6 mb-5 border-bottom" id="chart-container">
            <div class="text-center texto-graficas">
                <span>${questionText}</span>
            </div>
            <div id="${chartId}" class="pie-chart-reporte-respuestas"></div>
        </div>
    `;

    return htmlContent;
}
function generarUnaGraficaPastel(key, id, array_preguntas, array_obj_todaspreguntas_respuestas_estadisticas) {
    let data_pregunta_text = array_preguntas[key];
    let data_pre = array_obj_todaspreguntas_respuestas_estadisticas[key];
    let chartId = "chart-chart-reporte-pregunta-" + id;
    let chartData = [];
    
    for (let i = 0; i < data_pre.length; i++) {
        chartData.push({
            label: data_pre[i].opcion_texto,
            value: Number(data_pre[i].porcentaje_total).toFixed(2),
        });
    }

    // Crear el contenedor del gráfico llamando a la función
    let chartContainer = createChartContainer(data_pregunta_text, chartId);
    if ($("#listado-graficas-respuestas")) {
        $("#listado-graficas-respuestas").append(chartContainer);
        Morris.Donut({
            element: chartId,
            data: chartData,
            formatter: function (value, data) {
                return value + "%";
            },
        });
    } else {
        console.error("Graph placeholder not found.");
    }
}
function generarUnaGraficaDeBarras(key, id, array_preguntas, array_obj_todaspreguntas_respuestas_estadisticas) {
    let data_pregunta_text = array_preguntas[key];
    let data_pre = array_obj_todaspreguntas_respuestas_estadisticas[key];
    let chartId = "chart-chart-reporte-pregunta-" + id;
    let chartData = [];
    
    for (let i = 0; i < data_pre.length; i++) {
        chartData.push({
            y: data_pre[i].opcion_texto,
            a: Number(data_pre[i].porcentaje_total).toFixed(2),
        });
    }

    // Crear el contenedor del gráfico llamando a la función
    let chartContainer = createChartContainer(data_pregunta_text, chartId);
    if ($("#listado-graficas-respuestas")) {
        $("#listado-graficas-respuestas").append(chartContainer);
        Morris.Bar({
            element: chartId,
            data: chartData,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Porcentaje'],
            hideHover: 'auto',
            resize: true
        });
    } else {
        console.error("Graph placeholder not found.");
    }
}



function generarGraficasPastel(res) {
    let array_preguntas = res["todas-preguntas-texto"]["data"];
    let array_obj_todaspreguntas_respuestas_estadisticas = res["todas-preguntas-estadisticas"];
    // console.log(array_preguntas);
    const array_preguntas_keys = Object.keys(array_preguntas);
    // console.log(array_preguntas_keys);
    let contador=1;
    array_preguntas_keys.forEach(key => {
        if (array_obj_todaspreguntas_respuestas_estadisticas[key] !== undefined && array_obj_todaspreguntas_respuestas_estadisticas[key].length > 0) {
            generarUnaGraficaPastel(key, contador, array_preguntas, array_obj_todaspreguntas_respuestas_estadisticas);
            contador++; // Incrementar el contador después de cada iteración
        } else {
        }
    });
}


  function generarGraficasBarras(res) {
    let array_preguntas = res["todas-preguntas-texto"]["data"];
    let array_obj_todaspreguntas_respuestas_estadisticas = res["todas-preguntas-estadisticas"];
    // console.log(array_preguntas);
    $("#listado-graficas-respuestas").empty("");
    const array_preguntas_keys = Object.keys(array_preguntas);
    let contador=1;
    array_preguntas_keys.forEach(key => {
        if (array_obj_todaspreguntas_respuestas_estadisticas[key] !== undefined && array_obj_todaspreguntas_respuestas_estadisticas[key].length > 0) {
            generarUnaGraficaDeBarras(key, contador, array_preguntas, array_obj_todaspreguntas_respuestas_estadisticas);
            contador++; // Incrementar el contador después de cada iteración
        } else {
        }
    });
    }
  function CargarTipoGrafico(form_id, tipo_grafica = 0) {
    fnLimipiarGraficasReporteRespuestasCalidad();
    consultar_estadisticas_respuestas(form_id, tipo_grafica);
  }
</script>
{% include
"/encuestacalidadreporte/complementos/vdos/2024_enero/contenedor_graficas.volt"
%}

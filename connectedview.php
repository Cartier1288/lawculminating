<!doctype html>
<html>
  <head>
    <title>Introduction to Law</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
    <link rel="stylesheet" href="javascript/jquery.flowchart/jquery.flowchart.min.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=1100; initial-scale=1.0; target-densityDpi=device-dpi" />

    <meta name="keywords" content="Canadian, Law, Introduction, Overview, Summary, Interconnected" />
    <meta name="description" content="An introduction to Canadian Law." />
    <meta name="author" content="Isaac McQuaide" />
    <meta name="robots" content="all" />

    <link rel="shortcut icon" href="img/favicon.ico" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="javascript/jquery.panzoom/dist/jquery.panzoom.min.js"></script>
    <script src="javascript/jquery-mousewheel/jquery.mousewheel.min.js"></script>
    <script src="javascript/jquery.flowchart/jquery.flowchart.js"></script>

    <script src="javascript/universal.js"></script>

    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php
      include 'php/header.php';
    ?>
    <div class="connected-canvas">
      <div class="chart_container">
        <div id="connected-view"></div>
      </div>
    </div>

    <?php
      include 'php/footer.php';
    ?>

  </body>
</html>

<script type="text/javascript">
  $(document).ready(function() {
    var $flowchart = $("#connected-view");
    var $container = $flowchart.parent();

    var cx = $flowchart.width() / 2;
    var cy = $flowchart.height() / 2;

    $flowchart.panzoom();

    $flowchart.panzoom('pan', -cx + $container.width() / 2, -cy + $container.height() / 2);

    var zoomRatios = [0.25, 0.5, 0.75, 1.0, 1.25, 1.5, 2.0, 2.5, 3.0];
    var currentZoom = 2;

    $container.on('mousewheel.focal', function(ev) {
      ev.preventDefault();
      var delta = (ev.delta || ev.originalEvent.wheelDelta) || e.originalEvent.detail;
      var zoomOut = delta ? delta < 0 : e.originalEvent.deltaY > 0;
      currentZoom = Math.max(0, Math.min(zoomRatios.length - 1, (currentZoom + (zoomOut * 2 - 1))));
      $flowchart.flowchart('setPositionRatio', zoomRatios[currentZoom]);
      $flowchart.panzoom('zoom', zoomRatios[currentZooms], {
        animate: false,
        focal: ev
      });
    });

    var data = {
      operators: {
        operator1: {
          top: cy - 100,
          left: cx - 200,
          properties: {
            title: 'Operator 1',
            inputs: {},
            outputs: {
              output_1: {
                label: 'Output 1',
              }
            }
          }
        },
        operator2: {
          top: cy,
          left: cx + 140,
          properties: {
            title: 'Operator 2',
            inputs: {
              input_1: {
                label: 'Input 1',
              },
              input_2: {
                label: 'Input 2',
              },
            },
            outputs: {}
          }
        },
      },
      links: {
        link_1: {
          fromOperator: 'operator1',
          fromConnector: 'output_1',
          toOperator: 'operator2',
          toConnector: 'input_2',
        },
      }
    };

    $flowchart.flowchart({
      data: data
    });
  });
</script>

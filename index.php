<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
    	.alive {
            background-color: #0cbaba;
    	}

    	.dead {
            background-color: white;
        }
    </style>

    <title>Game of life!</title>
  </head>
  <body>
	<?php
        // initialize
        $maxI = 50;
        $maxJ = 150;
        $nuOfComunities = ($maxI * $maxJ) * 0.30;

	    // Generate random numbers for i and j
	    for ($x = 0; $x <= $nuOfComunities; $x++) {
	        $arrayRandom[rand(0, $maxI)][rand(0, $maxJ)] = 1;
	    }
	 ?>
     <div class="container-fluid">
    	<table class="gameCanvas">
    	    <?php for($i=0; $i<=$maxI; $i++): ?>
    		<tr>
	    	    <?php for($j=0; $j<=$maxJ; $j++): ?>
		            <td
                        id="<?php echo "td_{$i}_{$j}"; ?>"
                        class="<?php echo isset($arrayRandom[$i][$j]) ? 'alive' : 'dead' ?>"
                        data="<?php echo isset($arrayRandom[$i][$j]) ? '1' : '0'; ?>"
                        style="border-radius: 0px; border: 0px solid black; width: <?php echo 100/($maxJ+1); ?>vw; height: <?php echo 100/($maxI + 1); ?>vh;"
                        >
                    </td>
	    	    <?php endfor; ?>
    		</tr>
    	    <?php endfor; ?>
    	</table>
        <button class="start btn" style="position: absolute; top: 10px; left: 10px;">Start</button>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $( document ).ready(function() {
            $( ".start" ).click(function () {
            	var maxI = <?php echo $maxI; ?>;
            	var maxJ = <?php echo $maxJ; ?>;
            	var i = 0;
            	var j = 0;
                var generations = true;

                runGeneration(maxI, maxJ);
            });
        });

        function runGeneration(maxI, maxJ) {
            var aliveNeighbours = 0;
            var matrix = [];
            var active = false;

            for(var i=0; i <= maxI; i++) {
                matrix[i] = new Array(maxJ+1);
            }
            i = 0;

            for (i=0; i <= maxI; i++) {
                for (j=0; j <= maxJ; j++) {
                    aliveNeighbours = 0;
                    // Check neighbours
                    if ($("#td_" + (i-1) + "_" + (j-1) ).attr("data") == 1) {
                        aliveNeighbours++;
                    }
                    if ($("#td_" + (i-1) + "_" + j   ).attr("data") == 1) {
                        aliveNeighbours++;
                    }
                    if ($("#td_" + (i-1) + "_" + (j+1) ).attr("data") == 1) {
                        aliveNeighbours++;
                    }
                    if ($("#td_" + i     + "_" + (j+1) ).attr("data") == 1) {
                        aliveNeighbours++;
                    }
                    if ($("#td_" + i     + "_" + (j-1) ).attr("data") == 1) {
                        aliveNeighbours++;
                    }
                    if ($("#td_" + (i+1) + "_" + (j+1) ).attr("data") == 1) {
                        aliveNeighbours++;
                    }
                    if ($("#td_" + (i+1) + "_" + j   ).attr("data") == 1) {
                        aliveNeighbours++;
                    }
                    if ($("#td_" + (i+1) + "_" + (j-1) ).attr("data") == 1) {
                        aliveNeighbours++;
                    }

                    matrix[i][j] = aliveNeighbours;
                }
            }

            for (i=0; i <= maxI; i++) {
                for (j=0; j <= maxJ; j++) {
                    if (matrix[i][j] > 3 || matrix[i][j] < 2) {
                        $("#td_" + i + "_" + j).removeClass("alive");
                        $("#td_" + i + "_" + j).removeClass("dead");
                        $("#td_" + i + "_" + j).addClass("dead");
                        $("#td_" + i + "_" + j).attr("data", 0);
                    } else if (matrix[i][j] == 3) {
                        $("#td_" + i + "_" + j).removeClass("alive");
                        $("#td_" + i + "_" + j).removeClass("dead");
                        $("#td_" + i + "_" + j).addClass("alive");
                        $("#td_" + i + "_" + j).attr("data", 1);
                        active = true;
                    } else if ($("#td_" + i + "_" + j).attr("data") == 1) {
                        active = true;
                    }
                }
            }

            setTimeout(function () {
                if(active == true) {
                    active = runGeneration(maxI, maxJ);
                }
            }, 100);
        }
    </script>
  </body>
</html>

                            <br>
                        </div><!-- #main-content -->
                    </div>
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .container-fluid -->


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="/assets/scripts/main.js"></script>

        <script>
          // Диапазон расписания
          jQuery(document).ready(function($) {
            $( "#range-schedule" ).submit(function( event ) {
              var from = $( "#date-from" ).val();
              var to = $( "#date-to" ).val();
              location.href = '<?= ROUTE_METHOD ?>schedule/'+from+'/'+to;
              return false;
            });
          });
        </script>
    </body>
</html>

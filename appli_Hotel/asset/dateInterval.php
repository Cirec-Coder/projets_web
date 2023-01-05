  <!-- 
    Permet l'ajout de 2 Date Picker et leurs label respectif
    et un label supplémentaire pour afficher le compte du nombre de jours sélectionnés
    Le tout est géré automatiquement par le code js qui suit.

   -->
  <label>Du : </label>
  <input style="float: right;" onchange="Validate()" type="date" name="dFrom" id="dFrom" required="required" />
  <label>Au : </label>
  <input style="float: right;" onchange="Validate()" type="date" name="dTo" id="dTo" required="required" />
  <label style="float: right; justify-self: end; font-style: italic; color: gray" id="nbDays"></label>
  <!--  -->
  <!-- code javascript qui gère les saisis utilisateur -->
  <script type="text/javascript">
      pad = function(n, width, z) {
          z = z || '0';
          n = n + '';
          return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
      }

      // Formate la Date avec Leading Zero 
      // 2022-1-1 ==> 2022-01-01
      function formatDate(aDate) {
          with(aDate) {
              return getFullYear() + "-" + pad(getMonth() + 1, 2) + "-" + pad(getDate(), 2);
          }
      }

      // initialise la date et min à la date du jour
      function initDate() {
            // récuipère l'élément dFrom
          var dtFrom = document.getElementById('dFrom');
          // crée une nouvelle date (aujourd'hui)
          var dt1 = new Date();
          // conveti en string
          var fmtDate = formatDate(dt1);
          // et on met à jour les propriétés "min & "value" de l'élément dFrom
          dtFrom.min = fmtDate;
          dtFrom.value = fmtDate;

          // idem à j+1
          var dtTo = document.getElementById('dTo');
          dt1.setDate(dt1.getDate() + 1);
          fmtDate = formatDate(dt1);
          dtTo.min = fmtDate;
          dtTo.value = fmtDate;
          Validate();
      }

      // exécution automatique de la fonction initDate
      (() => {
          initDate();
      })()


      // Controle et Valide les dates saisies
      function Validate() {
          var dtFrom = document.getElementById('dFrom');
          var input1 = dtFrom.value;
          var dtTo = document.getElementById('dTo');
          var input2 = dtTo.value;


          if (input1 != "") {
              var date1 = new Date(input1);
              date1.setDate(date1.getDate() + 1);

              var dateMin2 = formatDate(date1);
              dtTo.setAttribute('min', dateMin2);

              if (input2 != "") {
                  var date2 = new Date(input2);
                  if (date2 < date1) {

                      dtTo.value = dateMin2;
                    //   dbg.log(dateMin2);
                  }
              } else {
                  dtTo.value = dateMin2;
              }
          }
          if (input1 != "" && input2 != "") {
              const milliSecondsPerDay = 1000 * 60 * 60 * 24;
              var lblNbDays = document.getElementById('nbDays');
              date1 = new Date(dtFrom.value);
              date2 = new Date(dtTo.value);
              // solution trouvée sur :
              //  https://stackoverflow.com/questions/3224834/get-difference-between-2-dates-in-javascript
              // La fonction Math.ceil() retourne le plus petit entier supérieur ou égal 
              // au nombre donné.
              const diffDays = Math.ceil(Math.abs(date2 - date1) / milliSecondsPerDay);
              lblNbDays.innerText = diffDays + " jours";
          }
          return true;
      }
  </script>
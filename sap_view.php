<?php global $path; ?>

<script type="text/javascript" src="<?php echo $path; ?>/Modules/sap/equations.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>/Modules/sap/solar.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>/Modules/sap/windowgains.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>/Modules/sap/utilisationfactor.js"></script>
<style>
  p {
    color:#222;
    font-style:italic;
  }

  input {
    width:80px;
  }

  .tag
  {
    font-size:12px; 
    color:#888; 
    padding:6px 2px 0px 2px; 
    float:right;
  }

.table tbody tr:hover td,
.table tbody tr:hover th {
    background-color: inherit;
}
</style>


<div class="container">
<br>
  <div class="row-fluid">
    <div class="span3">
      <h3>SAP 2012</h3>
        <ul class="nav nav-tabs nav-stacked" style="padding-left: 0px;">
          <li><a href="<?php echo $path; ?>sap/1" >1. Overall dwelling dimensions</a></li>
          <li><a href="<?php echo $path; ?>sap/2">2. Ventilation rate</a></li>
          <li><a href="<?php echo $path; ?>sap/3">3. Heat losses and heat loss parameter</a></li>
          <li><a href="<?php echo $path; ?>sap/4">4. Water heating energy requirement</a></li>
          <li><a href="<?php echo $path; ?>sap/5">5. Internal gains</a></li>
          <li><a href="<?php echo $path; ?>sap/6">6. Solar gains</a></li>
          <li><a href="<?php echo $path; ?>sap/7">7. Mean internal temperature</a></li>
          <li><a href="<?php echo $path; ?>sap/8">8. Space heating & cooling</a></li>
          <li><a href="<?php echo $path; ?>sap/9">9. Energy requirements</a></li>
          <li><a href="<?php echo $path; ?>sap/10">10. Fuel costs</a></li>
          <li><a href="<?php echo $path; ?>sap/11">11. SAP rating</a></li>
          <li><a href="<?php echo $path; ?>sap/H1">Appendix H1. Solar input for solar water heating</a></li>
        </ul>
    </div>
    <div class="span9">
      <?php require "compiled/".$page.".html"; ?>
    </div>
  </div>
</div>
    <script>

    var path = "<?php echo $path; ?>";
    var data = <?php echo $data; ?>;

    if (data==0)
    {
      data = {'H5a':1};
      $('input').each(function()
      {
        var id = $(this).attr('class');
        if (id) data[id] = $(this).val()*1;
      });
    }
    else
    {
      $('input').each(function()
      {
        var id = $(this).attr('class');
        if (id && data[id]==undefined) data[id] = $(this).val()*1;
      });
      for (z in data) {if (z) $('.'+z).val(data[z]);}
    }

    $('input').change(function()
    {
      var id = $(this).attr('class');
      if (id)
      {
        console.log(data);
        data[id] = $(this).val()*1;
        var last = JSON.parse(JSON.stringify(data));
        data = calculate(data);
        for (z in data)
        {
          if (z!=id && last[z]!=data[z]) { $("."+z).val(data[z]); $("."+z).attr('readonly', 'readonly');}
        }

        console.log(data);
        $.ajax({                                      
          type: "POST",
          url: path+"sap/save.json",           
          data: "&data="+encodeURIComponent(JSON.stringify(data)),
          success: function(msg) {console.log(msg);} 
        });
      }
    });

    var orientation = ['North','Northeast','East','Southeast','South','Southwest','West','Northwest'];
    var overshading = ['Heavy > 80%','More than average > 60%-80%','Average or unknown 20%-60%','Very little < 20%'];
    if (data['window']==undefined) data['window'] = [];

    solar_gains();
 
    function solar_gains()
    {
      var rows = "";
      for (i in data['window']) rows += solargainrow(i,data['window'][i]);
      $("#solargainstable tr:last").before(rows);

      $('#window_add').click(function()
      {
        data['window'].push({
          'orientation': $('#window_orientation').val(), 
          'area': $('#window_area').val(), 
          'overshading': $('#window_overshading').val(), 
          'g': $('#window_g').val(),  
          'ff': $('#window_ff').val()
        });

        var i = data['window'].length-1;
        $("#solargainstable tr:last").before( solargainrow(i,data['window'][i]) );

        // calculate solar gains from windows
        var gains = calc_solar_gains_from_windows(data['window'],data['H5a']);
        // copy over the calc results into the worksheet cells
        for (var z=1; z<13; z++) data['83-'+z] = gains[z-1];
        // recalculate and draw the worksheet
        data = calculate(data);
        for (z in data) if (z) $("."+z).val(data[z]);

        $.ajax({                                      
          type: "POST",
          url: path+"sap/save.json",           
          data: "&data="+encodeURIComponent(JSON.stringify(data)),
          success: function(msg) {console.log(msg);} 
        });
      });

      $(".delete").on('click', function(event) {
        var rowid = $(this).attr("rowid");
        data['window'].splice(rowid,1);

        // calculate solar gains from windows
        var gains = calc_solar_gains_from_windows(data['window'],data['H5a']);
        // copy over the calc results into the worksheet cells
        for (var z=1; z<13; z++) data['83-'+z] = gains[z-1];
        // recalculate and draw the worksheet
        data = calculate(data);
        for (z in data) if (z) $("."+z).val(data[z]);

        $.ajax({                                      
          type: "POST",
          url: path+"sap/save.json",           
          data: "&data="+encodeURIComponent(JSON.stringify(data)),
          success: function(msg) {console.log(msg);} 
        });

       	$(this).parent().parent().remove();
      });

    }

    function solargainrow(i,window)
    {
      var row = "";
      row += "<tr>";
      row += "<td>"+orientation[window['orientation']]+"</td>";
      row += "<td>"+window['area']+" m2</td>";
      row += "<td>"+overshading[window['overshading']]+"</td>";
      row += "<td>"+window['g']+"</td>";
      row += "<td>"+window['ff']+"</td>";
      row += "<td><input class='delete' type='button' value='x' rowid='"+i+"' / ></td>";
      row += "</tr>";
      return row;
    }

    /*

    Heat loss interface

    */
    if (data['heatlossitems']==undefined) data['heatlossitems'] = [];
    heatlossitems();

    function heatlossitems()
    {
      var rows = "";
      for (i in data['heatlossitems']) rows += heatlossitemrow(i,data['heatlossitems'][i]);
      $("#heatlosstable tr:last").before(rows);

      $('#heatlossitem_add').click(function()
      {
        data['heatlossitems'].push({
          'itemname': $('#heatlossitem-itemname').val(), 
          'grossarea': parseFloat($('#heatlossitem-grossarea').val()), 
          'openings': parseFloat($('#heatlossitem-openings').val()), 
          'netarea': parseFloat($('#heatlossitem-netarea').val()), 
          'uvalue': parseFloat($('#heatlossitem-uvalue').val()),  
          'axu': parseFloat($('#heatlossitem-axu').val()),
          'kvalue': parseFloat($('#heatlossitem-kvalue').val()),
          'axk': parseFloat($('#heatlossitem-axk').val())
        });

        var i = data['heatlossitems'].length-1;

        data['heatlossitems'][i].netarea = data['heatlossitems'][i].grossarea - data['heatlossitems'][i].openings;
        data['heatlossitems'][i].axu = data['heatlossitems'][i].netarea * data['heatlossitems'][i].uvalue;
        data['heatlossitems'][i].axk = data['heatlossitems'][i].netarea * data['heatlossitems'][i].kvalue;

        $("#heatlosstable tr:last").before( heatlossitemrow(i,data['heatlossitems'][i]) );


        var totalarea = 0, totalheatloss = 0;
        for (z in data['heatlossitems']) {
          totalarea += data['heatlossitems'][z].netarea;
          totalheatloss += data['heatlossitems'][z].axu;
        }
        data['31'] = totalarea;
        data['externalheatloss'] = totalheatloss;

        // copy over the calc results into the worksheet cells
        //for (var z=1; z<13; z++) data['83-'+z] = gains[z-1];
        // recalculate and draw the worksheet
        data = calculate(data);
        for (z in data) if (z) $("."+z).val(data[z]);

        $.ajax({                                      
          type: "POST",
          url: path+"sap/save.json",           
          data: "&data="+encodeURIComponent(JSON.stringify(data)),
          success: function(msg) {console.log(msg);} 
        });
      });

      $(".delete").on('click', function(event) {
        var rowid = $(this).attr("rowid");
        data['heatlossitems'].splice(rowid,1);

        // calculate solar gains from windows
        // var gains = calc_solar_gains_from_windows(data['heatlossitems'],data['H5a']);
        // copy over the calc results into the worksheet cells
        // for (var z=1; z<13; z++) data['83-'+z] = gains[z-1];
        // recalculate and draw the worksheet
        data = calculate(data);
        for (z in data) if (z) $("."+z).val(data[z]);

        $.ajax({                                      
          type: "POST",
          url: path+"sap/save.json",           
          data: "&data="+encodeURIComponent(JSON.stringify(data)),
          success: function(msg) {console.log(msg);} 
        });

       	$(this).parent().parent().remove();
      });

    }

    function heatlossitemrow(i,heatlossitem)
    {
      var row = "";
      row += "<tr>";
      row += "<td>"+heatlossitem.itemname+"</td>";
      row += "<td>"+heatlossitem.grossarea+"</td><td></td>";
      row += "<td>"+heatlossitem.openings+"</td><td></td>";
      row += "<td>"+heatlossitem.netarea+"</td><td></td>";
      row += "<td>"+heatlossitem.uvalue+"</td><td></td>";
      row += "<td>"+heatlossitem.axu+"</td>";
      row += "<td>"+heatlossitem.kvalue+"</td>";
      row += "<td>"+heatlossitem.axk+"</td>";
      row += "<td><input class='delete' type='button' value='x' rowid='"+i+"' / ></td>";
      row += "</tr>";
      return row;
    }

    </script>


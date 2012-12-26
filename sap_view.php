<?php global $path; ?>

<script type="text/javascript" src="<?php echo $path; ?>Lib/flot/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>/Modules/sap/equations.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>/Modules/sap/solar.js"></script>
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
      data = {};
      $('input').each(function()
      {
        var id = $(this).attr('class');
        data[id] = $(this).val()*1;
      });
    }
    else
    {
      for (z in data) $('.'+z).val(data[z]);
    }

    $('input').change(function()
    {
      var id = $(this).attr('class');
      data[id] = $(this).val()*1;
      var last = JSON.parse(JSON.stringify(data));
      data = calculate(data);
      for (z in data)
      {
        if (z!=id && last[z]!=data[z]) { $("."+z).val(data[z]); $("."+z).attr('readonly', 'readonly');}
      }

      $.ajax({                                      
        type: "POST",
        url: path+"sap/save.json",           
        data: "&data="+encodeURIComponent(JSON.stringify(data)),
        success: function(msg) {console.log(msg);} 
      });
    });


    </script>


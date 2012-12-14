<?php global $path; ?>

<script type="text/javascript" src="<?php echo $path; ?>Lib/flot/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>/Modules/sap/equations.js"></script>

<style>
  p {
    color:#222;
    font-style:italic;
  }

  input {
    width:80px;
  }

.table tbody tr:hover td,
.table tbody tr:hover th {
    background-color: inherit;
}
</style>

<h1>SAP Worksheet 2012</h1>
<?php require "form.html"; ?>

    <script>
  var path = "<?php echo $path; ?>";
    var data = <?php echo $data; ?>;
    console.log(data);
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
        if (z!=id && last[z]!=data[z]) $("."+z).val(data[z]);
      }

      $.ajax({                                      
        type: "POST",
        url: path+"sap/save.json",           
        data: "&data="+encodeURIComponent(JSON.stringify(data)),
        success: function(msg) {console.log(msg);} 
      });
    });


    </script>


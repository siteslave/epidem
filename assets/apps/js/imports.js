$(function() {
   var imports = {};

   imports.ajax = {
       get_list: function(s, e, cb){
           var url = '/brands/save',
               params = {
                   s: s,
                   e: e
               };

           app.ajax(url, params, function(err, data){
               err ? cb(err) : cb(null, data);
           });
       }
   }; 
   
   //get import list
   $('#btn_get_list').on('click', function(e) {
       var s = $('#txt_start_date').val();
       var e = $('#txt_end_date').val();
       
       if(!s)
       {
           app.alert('กรุณาระบุวันที่เริ่มต้น');
       }
       else if(!e)
       {
           app.alert('กรุณาระบุวันที่สิ้นสุด');
       }
       else 
       {
           imports.get_list(s, e);
       }
       
       e.preventDefault(); 
   });
   
   imports.get_list = function(s, e) {
       
        imports.ajax.get_list(s, e, function(err, data) {
            if(err)
            {
                app.alert(err);
            }
            else 
            {
                imports.set_list(data.rows)
            }
        });
	
   };
   
   imports.set_list: function(data) {
       
       $('#tbl_list > tbody').empty();
       
       if(data)
       {
           
           var i = 1;
           
           _.each(data, function(v) {
               
               $('#tbl_list > tbody').append(
                   '<tr>' +
                   '<td>' + i + '</td>' +
                   '<td>' + v.date_serv + '</td>' +
                   '<td>' + v.cid + '</td>' +
                   '<td>' + v.fullname + '</td>' +
                   '<td>' + v.birthdate + '</td>' +
                   '<td>' + v.age + '</td>' +
                   '<td>' + v.icd + '</td>' +
                   '<td><a href="javascript:void();" class="btn btn-success"> ' +
                   '<i class="icon-save"></i></a></td>' +
               );
               
               i++;
               
           });
       }
       else 
       {
           $('#tbl_list > tbody').append('<tr><td colspan="8">ไม่พบข้อมูล</td></tr>');
       }
   }
   
});
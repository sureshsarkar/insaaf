// Add vendor
$(document).on('submit','.vendor_detail',function(){
    let url=$(this).attr('action');
    let data =$(this).serialize();
        alert(' Add Lawyer');
  
});
// Add Customer
$(document).on('submit','.customer_detail',function(){
    let url=$(this).attr('action');
    let data =$(this).serialize();
        alert(' Add Customer');
  
});
// Update vendor
$(document).on('submit','.vendor_detail1',function(){
    let url=$(this).attr('action');
    let data =$(this).serialize();
    $.post(url,data,function(){
        alert('Are you sure to update');
    })
})

// Update Customer
$(document).on('submit','.customer_detail1',function(){
    let url=$(this).attr('action');
    let data =$(this).serialize();
    $.post(url,data,function(){
        alert('Are you sure to update');
    })
})
// Delete user
$(document).on('click','.delete_user',function(){
 let id=$(this).attr('data-id');
 let del=$('a href[id="delete_user_'+id+'"]:clicked').val();
 if(del==undefined){
     alert('Are you sure to delete')
 }
}
);

// Delete Customer
$(document).on('click','.delete_customer',function(){
    let id=$(this).attr('data-id');
    let del=$('a href[id="delete_customer_'+id+'"]:clicked').val();
    if(del==undefined){
        alert('Are you sure to delete')
    }
   }
   );
// Change Vendor Status 
$(document).on('change','.manage-user-status',function(){
    var id=$(this).attr('data-id');
    var status=$('input[id="status_'+id+'"]:checked').val();
    
    if(status==undefined){
        status=0; 
    }
   $.post(base_url+'users/manage_status',{id:id,status:status},function(fb){ 
       alert('Lawyer status update successfully');
   });
    
}
);

// Change Customer Status

$(document).on('change','.manage-customer-status',function(){
    var id=$(this).attr('data-id');
    var status=$('input[id="status_'+id+'"]:checked').val();
    
    if(status==undefined){
        status=0; 
    }
   $.post(base_url+'users/manage_status',{id:id,status:status},function(fb){ 
       alert(' Customer status update successfully');
   });
    
}
);

// Add Category
$(document).on('submit','.category_detail',function(){
    let url=$(this).attr('action');
    let data =$(this).serialize();
        alert(' Add Category');
  
});
// Update category
$(document).on('submit','.category_detail1',function(){
    let url=$(this).attr('action');
    let data =$(this).serialize();
    $.post(url,data,function(){
        alert('Are you sure to update category');
    })
})
// Delete Category
$(document).on('click','.delete_category',function(){
    let id=$(this).attr('data-id');
    let del=$('a href[id="delete_category_'+id+'"]:clicked').val();
    if(del==undefined){
        alert('Are you sure to delete')
    }
   }
   );
// Change Category Status
$(document).on('change','.manage-category-status',function(){
    var id=$(this).attr('data-id');
    var status=$('input[id="status_'+id+'"]:checked').val();
    if(status==undefined){
        status=0; 
    }
   $.post(base_url+'products/manage_status',{id:id,status:status},function(fb){ 
    alert(' Category status update successfully');

   });
    
}
);
// Add Sub Category
$(document).on('submit','.sub_category_detail',function(){
    let url=$(this).attr('action');
    let data =$(this).serialize();
        alert(' Add Sub Category');
  
});
// Delete Sub Category
$(document).on('click','.delete_sub_category',function(){
    let id=$(this).attr('data-id');
    let del=$('a href[id="delete_sub_category_'+id+'"]:clicked').val();
    if(del==undefined){
        alert('Are you sure to delete sub category')
    }
   }
   );

// Change Sub Category Status
$(document).on('change','.manage-sub_category-status',function(){
    var id=$(this).attr('data-id');
    var status=$('input[id="status_'+id+'"]:checked').val();
    if(status==undefined){
        status=0; 
    }
   $.post(base_url+'products/manage_sub_category_status',{id:id,status:status},function(fb){ 
    alert(' Category status update successfully');

   });
    
}
);
// Update Sub category
$(document).on('submit','.sub_category_detail1',function(){
    let url=$(this).attr('action');
    let data =$(this).serialize();
    $.post(url,data,function(){
        alert('Are you sure to update sub category');
    })
})
// Add Brand
$(document).on('submit','.brand_detail',function(){
    let url=$(this).attr('action');
    let data =$(this).serialize();
        alert(' Add  brand');
  
});
// Delete Brant
$(document).on('click','.delete_brand',function(){
    let id=$(this).attr('data-id');
    let del=$('a href[id="delete_category_'+id+'"]:clicked').val();
    if(del==undefined){
        alert('Are you sure to delete Brand')
    }
   }
   );
   // Update Sub category
$(document).on('submit','.brand_detail1',function(){
    let url=$(this).attr('action');
    let data =$(this).serialize();
    $.post(url,data,function(){
        alert('Are you sure to update Brand');
    })
})
// Change Category Status
$(document).on('change','.manage-brand',function(){
    var id=$(this).attr('data-id');
    var status=$('input[id="status_'+id+'"]:checked').val();
    if(status==undefined){
        status=0; 
    }
   $.post(base_url+'products/manage_brand_status',{id:id,status:status},function(fb){ 
    alert('Brand status update successfully');

   });
}
);

//  Select Sub Category on the bases of category
$(document).on('change','#category1',function(){
     let id=$(this).val();
     let url=$(this).attr('data-url');
     if(id!=''){
           $.post(url,{id:id},function(fb){ 
           $('#sub_category').html(fb);
       });
   }else{
    $('#sub_category').html("<option value=''>Select Sub Category</option>"); 
   }
});

// Add Product
// $(document).on('submit','.add_new_product',function(){
//     let url=$(this).attr('action');
//     let data =$(this).serialize();
//     $.post(url,data,function(fb){
//         alert('Add Product');
//     });
// });


// Add New Product
$(document).on('submit','.add_new_product',function(){
    var url=$(this).attr('action');
    var data=new FormData($(this)[0]);
    $.ajax({
        type:'POST',
        url:url,
        data:data,
        contentType:false,
        processData:false,
        success:function(fb)
        {
            console.log(fb);
            var resp=$.parseJSON(fb);
            if(resp.status=='true')
            {
              alert(resp.message);
              window.location.href=resp.reload;      
            }
            else
            {
                alert(resp.message); 
            }
        }


    });
    return false;
});
// Delete Brant
$(document).on('click','.delete_color',function(){
    let id=$(this).attr('data-id');
    let del=$('a href[id="delete_category_'+id+'"]:clicked').val();
    if(del==undefined){
        alert('Are you sure to delete Color')
    }
   }
   );

// Update  Color
$(document).on('submit','.color_detail1',function(){
    let url=$(this).attr('action');
    let data =$(this).serialize();
    $.post(url,data,function(){
        alert('Are you sure to update Color');
    })
})

// Change Color Status
$(document).on('change','.manage-color',function(){
    var id=$(this).attr('data-id');
    var status=$('input[id="status_'+id+'"]:checked').val();
    if(status==undefined){
        status=0; 
    }
   $.post(base_url+'products/manage_color_status',{id:id,status:status},function(fb){ 
    alert('Color status update successfully');

   });
}
);
// Delete Product
$(document).on('click','.delete_product',function(){
    let id=$(this).attr('data-id');
    let del=$('a href[id="delete_product_'+id+'"]:clicked').val();
    if(del==undefined){
        alert('Are you sure to delete Product')
    }
});

// change Product status
$(document).on('change','.manage-product-status',function(){
    
    var id=$(this).attr('data-id');
    var status=$('input[id="status_'+id+'"]:checked').val();
   
    if(status==undefined){
        
        status=0;
    }
    $.post(base_url+'products/manage_product_status',{id:id,status:status},function(){
        alert("Product status change successfully");
    })
})
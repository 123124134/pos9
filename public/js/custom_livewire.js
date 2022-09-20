window.addEventListener("closeModel", event=>{
    $('#addSection').modal('hide');
    $('.modal-backdrop').remove();
});

// Success Message Dialog
window.addEventListener('MSGSuccessfull',event=>{
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });
      
      Toast.fire({
        icon: 'success',
        title: event.detail.title
      });
});

// Delete Section

window.addEventListener('swal:DeletedRecord', event =>{
    Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
      
        if (result.isConfirmed) {
            // alert(event.detail.id);
            window.livewire.emit('RecordDeleted', event.detail.id)
          Swal.fire("Deleted!","Record Deleted Successfully!","success");
        }
      });
    
})

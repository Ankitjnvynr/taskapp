
let statusChk = document.getElementById('statusChk');
let statusMSg = document.getElementById('statusMSg');
let updateTask = document.getElementById('updateTask')
let updateID = document.getElementById('updateID')
let past = document.getElementById('Past')
let filterDate = document.getElementById('filterDate')

changeStatus = (e) => {
    let state = e.checked ? 'Done' : 'pending';
    $.ajax({
        url: 'assest/_updateStatus.php',
        type: 'POST',
        data: {
            taskid: e.value,
            state: state
        },
        success: (response) => {
            console.log(response)
        }
    })
}


function validateImage() {
    var input = document.getElementById('updatePic');
    var file = input.files[0];

    if (file) {
        var allowedTypes = ['image/jpeg',
            'image/png',
            'image/gif']; // Add more image types if needed

        if (allowedTypes.includes(file.type)) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = new Image();
                img.src = e.target.result;

                img.onload = function () {
                    // Check if the file is an image
                    if (img.width > 0 && img.height > 0) { } else {
                        $('#toastBody').text("It is not an Image !")
                        toastBootstrap.show()
                        // Clear the file input if the selected file is not an image
                        input.value = '';
                    }
                };
            };

            reader.readAsDataURL(file);
        } else {
            alert('Invalid file type. Please select a valid image.');
            // Clear the file input if the selected file is not an allowed image type
            input.value = '';
        }
    }
}





$(document).ready(() => {
    const today = new Date()
    const tomorrow = new Date(today)
    tomorrow.setDate(today.getDate() - 1)
    day = '0' + tomorrow.getDate()
    month = '0' + (tomorrow.getMonth() + 1)
    year = tomorrow.getFullYear()
    d = year + '-' + month.slice(-2) + '-' + day.slice(-2)
    // console.log(d)
    filterDate.value = d

    const toastTrigger = document.getElementById('liveToastBtn')
    const toastLiveExample = document.getElementById('liveToast')
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)



    load = () => {
        $.ajax({
            url: 'assest/_loadtask.php',
            success: (res) => {
                $('.allTask').html(res)
                console.log("loaded again")

            }
        })
    }
    loadpast = () => {
        $.ajax({
            url: 'assest/_loadtask.php',
            type: 'POST',
            data: {
                filter: $(filterDate).val()
            },
            success: (res) => {
                $('#Past').html(res)
                past.innerHTML = res
                // console.log(past)
            }
        })
    }
    sEdits = () => {
        setTimeout(() => {
            let Edits = document.querySelectorAll('.editBtn')
            Array.from(Edits).forEach((e) => {
                $(e).on('click', () => {
                    let tr = e.parentElement.parentElement;
                    let b = tr.getElementsByTagName('td')[0]
                    updateTask.value = b.children[0].innerHTML
                    ufromTime.value = b.children[2].innerHTML
                    utoTime.value = b.children[4].innerHTML
                    // console.log(b.children[2],"  ",b.children[4])
                    updateID.value = e.dataset.editid;

                })
            })
        }, 500);
    }

    deleteTask = (del) => {
        a = confirm("Are you sure to delete ?")
        if (a) {
            console.log(del);
            $.ajax({
                url: 'assest/_delete.php',
                data: {
                    delid: del
                },
                type: 'POST',
                success: (data) => {
                    // console.log(data)
                    load();
                    loadpast();
                    $('#toastBody').text("Task deleted !")
                    toastBootstrap.show()
                }

            })
        }
    }






    userImage = () => {
        $.ajax({
            url: 'assest/_userPic.php',
            success: (res) => {
                $('#uPic').html(res)

            }
        })
    }
    userImage();

    $('#myForm').on('submit', (e) => {
        e.preventDefault(); // Prevents the default form submission behavior

        $.ajax({
            url: 'assest/_add.php', // The server-side script to handle the form data
            type: 'POST', // HTTP request type
            data: {
                task: $('#task').val(), // Getting the value of the 'task' input
                fromTime: $('#fromTime').val(), // Getting the value of the 'fromTime' input
                toTime: $('#toTime').val(), // Getting the value of the 'toTime' input
            },
            success: (response) => {
                load(); // Assuming load() is a function to update the UI or perform some action after successful submission
                sEdits(); // Assuming sEdits() is another function being called after successful submission
                $('#myForm')[0].reset(); // Resetting the form after successful submission
                // Logging the server's response to the console
                $('#toastBody').text("New task added !")
                toastBootstrap.show()
            }
        });

    });


    // Handle file upload when the "Upload Image" button is clicked
    $('#uploadImage').on('click', function () {
        let fileInput = $('#updatePic')[0];
        let file = fileInput.files[0];

        if (file) {
            let formData = new FormData();
            formData.append('image', file);

            $.ajax({
                url: 'assest/_uploadImage.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#updateImgMsg').html(response)
                    console.log(response)
                    userImage();
                    $('#toastBody').text("Profile picture updated !")
                    toastBootstrap.show()
                    // Handle the server's response here
                },
                error: function (error) {
                    console.log(error);

                    // Handle errors here
                }
            });
        } else {
            console.log('No file selected.');
        }
    });



    load()
    loadpast()
    sEdits()

    $('#UpdateForm').on('submit',
        (e) => {
            e.preventDefault();
            $.ajax({
                url: 'assest/_update.php',
                type: 'POST',
                data: {
                    uptask: updateTask.value,
                    upid: updateID.value,
                    ufromTime: $('#ufromTime').val(),
                    utoTime: $('#utoTime').val(),
                },
                success: (response) => {
                    console.log(response)
                    load();
                    loadpast();
                    sEdits()

                    $('#UpdateModal').modal('hide');
                    $('#toastBody').text("Task updated !")
                    toastBootstrap.show()
                }
            })
        })

    $('#updatePass').on('submit',
        (e) => {
            e.preventDefault();
            $.ajax({
                url: 'assest/_updatePass.php',
                type: 'POST',
                data: {
                    updatePassword: $('#updatePassword').val(),
                },
                success: (response) => {
                    $('#msgpupdate').html(response)
                    $('#toastBody').text("Password updated !")
                    toastBootstrap.show()
                    $('#updatePass')[0].reset()
                }
            })
        })






})

function copyColumn(columnIndex) {
    var table = $("#todayTable");
    var columnData = [];

    // Loop through each row and get the content of the specified column
    table.find("tr").each(function () {
        var cells = $(this).find("td");
        if (cells.length > columnIndex) {
            columnData.push(cells.eq(columnIndex).text());
        }
    });

    // Join the column data into a string separated by line breaks
    var textToCopy = columnData.join("\n");
$('body').append(textToCopy)
    // Use the Clipboard API to copy text to the clipboard
    if (navigator.clipboard) {
        navigator.clipboard.writeText(textToCopy).then(function () {
            // Successfully copied to clipboard
            alert("Column copied to clipboard!");
        }).catch(function (err) {
            // Unable to copy to clipboard
            console.error('Unable to copy to clipboard', err);
        });
    } else {
        // Clipboard API not supported, provide fallback or inform the user
        alert("Your browser does not support the Clipboard API. Please copy the text manually.");
    }
}







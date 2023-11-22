<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validasi Password Sama</title>
    <style>
        .needs-validation {
            background-color: #f5f5f5;
        }

        .needs-validation:valid {
            background-color: #fff;
        }

        .needs-validation:invalid {
            background-color: #ffebeb;
        }

        .custom-input:invalid {
            border-bottom-color: #899bbd;
        }

        .custom-input:empty {
            border-bottom-color: #899bbd;
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }

        .empty-feedback {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }

    </style>
</head>
<body>
<form action="" method="post" class="needs-validation">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="confirm_password" placeholder="Konfirmasi Password">
    <button type="submit">Submit</button>
</form>
</body>

<script>
    var needsValidation = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(needsValidation)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                var password = document.querySelector('input[name="password"]').value
                var confirmPassword = document.querySelector('input[name="confirm_password"]').value

                if (password !== confirmPassword) {
                    event.preventDefault()
                    event.stopPropagation()

                    form.querySelector('input[name="confirm_password"]').classList.add('is-invalid')
                }

                form.classList.add('was-validated')
            }, false)
        })


</script>
</html>

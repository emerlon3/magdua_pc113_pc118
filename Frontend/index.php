<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
            width: 400px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }
        .input-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input {
            display: block;
            width: 90%;
            margin: 10px 0;
            padding: 12px;
            border: none;
            border-radius: 5px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            text-align: center;
        }
        input:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(110, 142, 251, 0.8);
        }
        button {
            width: 100%;
            padding: 12px;
            background: #6e8efb;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }
        button:hover {
            background: #576fd6;
        }
        #message {
            margin-top: 15px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <div class="input-container">
            <input type="email" id="email" placeholder="Email" required>
            <input type="password" id="password" placeholder="Password" required>
        </div>
        <button onclick="login()">Login</button>
        <p id="message"></p>
    </div>

    <script>
        async function login() {
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const message = document.getElementById("message");

            const response = await fetch("http://127.0.0.1:8000/api/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();
            if (response.ok) {
                message.textContent = "Login successful! Redirecting...";
                message.style.color = "green";
                setTimeout(() => {
                    window.location.href = "dashboard.html";
                }, 2000);
            } else {
                message.textContent = "Login failed: " + data.message;
                message.style.color = "red";
            }
        }
    </script>
</body>
</html>
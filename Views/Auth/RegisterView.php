<?php
class RegisterView
{
    public function render($message = "")
    {
        echo <<<HTML
        <form method="POST" action="/register">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Register</button>
        </form>
        <p>$message</p>
        HTML;
    }
}

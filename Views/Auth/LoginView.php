<?php
class LoginView
{
    public function render()
    {
        echo <<<HTML
        <form method="POST" action="/login">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        HTML;
    }
}

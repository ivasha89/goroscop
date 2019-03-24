<nav class="navbar sticky-top navbar-expand-md navbar-light mb-2 shadow">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/users') }}">Общая таблица</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/compare') }}">Таблица по совпадениям</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/users/create') }}">Внести в список</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ url('/') }}">Домой</a>
        </li>
    </ul>
        <div class="top-right links">
            <a href="https://j108.ru">Jyotish M. C.</a>
            <a href="http://www.lagna.ru/">Lagna</a>
        </div>
</nav>
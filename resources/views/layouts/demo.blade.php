<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') · Build Real Code</title>
    <style>
        :root { color-scheme: dark; }
        body { margin: 0; background: #0f1117; color: #e6e6e6; font: 18px/1.5 ui-sans-serif, system-ui, sans-serif; }
        h1 { margin: 0; font-size: 32px; }
        ul { margin: 6px 0 0; padding-left: 22px; }
        code { font-family: "JetBrains Mono", ui-monospace, monospace; font-size: 15px; }
        .page { display: flex; flex-direction: column; gap: 24px; max-width: 1100px; margin: 0 auto; padding: 24px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 12px; }
        .card { background: #161a24; border: 1px solid #2a3142; border-radius: 12px; padding: 14px 18px; }
        .muted { color: #9aa4b8; }
        .query-log { order: -1; position: sticky; top: 0; z-index: 1; }
        .query-log h2 { margin: 0 0 8px; font-size: 28px; }
        .query-log summary { cursor: pointer; color: #9aa4b8; }
        .query-log ol { margin: 8px 0 0; padding-left: 28px; max-height: 260px; overflow: auto; }
        .query-count { color: #ff6b6b; }
        .query-count.is-healthy { color: #51cf66; }
    </style>
</head>
<body>
<main class="page">
    @yield('content')

    <x-query-log />
</main>
</body>
</html>

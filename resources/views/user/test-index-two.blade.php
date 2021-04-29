<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiles</title>
    <link href="/css/test.css" rel="stylesheet">
</head>
<body>
    <navbar>
        <div class="nav-links-container">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="{{ route('user.index')}}" class="nav-link">Profiles</a>
                </li>
                <li class="nav-item active">
                    <a href="{{ route('games.index')}}" class="nav-link">Games</a>      
                </li>
                <li class="nav-item active">
                    <a href="{{ route('conference.index')}}" class="nav-link">Conferences</a>      
                </li>
                <li class="nav-item active">
                    <a href="{{ route('division.index')}}" class="nav-link">Divisions</a>      
                </li>
                <li class="nav-item active">
                    <a href="{{ route('nbi.index')}}" class="nav-link">NBI</a>      
                </li>
      
            </ul>
        </div>
    </navbar>
    <contentBox>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Hash<th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                </tbody>
            </table>
        </div>
    </contentBox>
</body>
</html>
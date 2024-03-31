<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Center colloboration</title>
</head>
<body>
   
    <!--END SIDEBAR-->
    
    <!--END CONTENT-->
      <section id="content">
 
       <!--END CONTENT -->
       <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li> <a href="#">Dashboard </a>
                    </li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li><a   class="active" href="#">Home</a></li>
                </ul>
            </div>
            <a href="" class="btn-downlaod">
                <i class='bx bxs-right-top-arrow-circle'></i>
                <span class="text">downlaod PDF</span>
            </a>
          </div>
          <ul class="box-info">
            <li><i class='bx bxs-calendar-check'></i>
                <span class="text"><h3>1020</h3></span>
                <p>New Order</p>
            </li>
            <li><i class='bx bxs-group'></i>
                <span class="text"><h3>2834</h3></span>
                <p>VIsitors</p>
            </li>
            <li><i class='bx bx-dollar'></i>
                <span class="text"><h3>2543 </h3></span>
                <p>Total Sales</p>
            </li>
          </ul>
          <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Recents Orders</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter' ></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Users</th>
                                <th>Date Orders</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                 <img src="assets/img/patient_3.jpg">
                                 <p>Keila Ngoma</p>
                                </td>
                                <td>06-01-2024</td>
                                <td><span class="status completed">
                                    Completed
                                </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                 <img src="assets/img/patient_3.jpg">
                                 <p>Keila Ngoma</p>
                                </td>
                                <td>06-01-3024</td>
                                <td><span class="status completed">
                                    Organisation
                                </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                 <img src="assets/img/patient_3.jpg">
                                 <p>Keila Ngoma</p>
                                </td>
                                <td>06-01-2024</td>
                                <td><span class="status precess">
                                    Process
                                </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                 <img src="assets/img/patient_3.jpg">
                                 <p>Keila Ngoma</p>
                                </td>
                                <td>06-01-2024</td>
                                <td><span class="status completed">
                                    Completed
                                </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                 <img src="assets/img/patient_3.jpg">
                                 <p>Keila Ngoma</p>
                                </td>
                                <td>06-01-2024</td>
                                <td><span class="status pending">
                                    pending
                                </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="todo">
                    <div class="order">
                        <div class="head">
                            <h3>Todos</h3>
                            <i class='bx bx-plus'></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <ul class="todo-list">
                            <li class="completed">
                            <p>Todo List</p>
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </li>
                            <li class="completed">
                                <p>Todo List</p>
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </li>
                             <li id="not-completed">
                                <p>Todo List</p>
                                 <i class="bx bx-dots-vertical-rounded"></i>
                                 </li>
                               <li  class="completed">
                                 <p>Todo List</p>
                                  <i class="bx bx-dots-vertical-rounded"></i>
                             </li>
                             <li id="not-completed">
                                <p>Todo List</p>
                                 <i class="bx bx-dots-vertical-rounded"></i>
                            </li>
                        </ul>
                    </div>
                </div>
          </div>
        </main>
    <!--START MAIN-->
      </section>
    
    

    <script src="assets/js/script.js"></script>
</body>
</html>
<x-layout>
<div class="row center">
    <div class="col top">
        <h1>Dashboard</h1>
        <ul>
            <li class="active">All</li>
            <li>Fire</li>
            <li>Police</li>
            <li>Medical</li>
        </ul>
    </div>
    <div class="col middle">
        <div class="card">
            <span class="headers">
                <h3>Fire</h3>
                <h3>21%</h3>
            </span>
            <span class="td">
                <h4>Standby</h4>
                <h4>16</h4>
            </span>
            <span class="td">
                <h4>On Call</h4>
                <h4>53</h4>
            </span>
            <span class="td">
                <h4>Break</h4>
                <h4>5</h4>
            </span>
        </div>
        <div class="card">
            <span class="headers">
                <h3>Medical</h3>
                <h3>36%</h3>
            </span>
            <span class="td">
                <h4>Standby</h4>
                <h4>16</h4>
            </span>
            <span class="td">
                <h4>On Call</h4>
                <h4>53</h4>
            </span>
            <span class="td">
                <h4>Break</h4>
                <h4>5</h4>
            </span>
        </div>
        <div class="card">
            <span class="headers">
                <h3>Police</h3>
                <h3>53%</h3>
            </span>
            <span class="td">
                <h4>Standby</h4>
                <h4>16</h4>
            </span>
            <span class="td">
                <h4>On Call</h4>
                <h4>53</h4>
            </span>
            <span class="td">
                <h4>Break</h4>
                <h4>5</h4>
            </span>
        </div>
        
    </div>
    <!-- LOG CHART -->
    <div class="col bottom">
        <canvas id="logChart"></canvas>
    </div>
    
</div>
<div class="row right">
    
    <div class="col top">
        <span class="icon icon-bell"><i class="fa-solid fa-bell"></i><span class="dot dot-notif"></span></span>
        <div class="avatar">
            <span>
            <small>Hey,</small>
            <small> {{auth()->user()->fname}}</small>
            </span>
            <img src="{{auth()->user()->avatar ? asset('storage/'. auth()->user()->avatar) : asset('img/avatar.png')}}" alt="avatar">
        </div>
        
    </div>
    <div class="emergency">
        <h3>Emergencies</h3>
        <div class="item">
            <span>
                <h4>Responses</h4>
                <small>23%</small>
            </span>
            <h4 class="amount">256</h4>
        </div>
        <div class="item">
            <span>
                <h4>Requests</h4>
                <small>42%</small>
            </span>
            <h4 class="amount">546</h4>
        </div>
        <div class="item">
            <span>
                <h4>Completed</h4>
                <small>15%</small>
            </span>
            <h4 class="amount">152</h4>
        </div>
    </div>

    <!-- GRAPH 1 -->
    <div class="col bottom">
        <canvas id="graph"></canvas>
    </div>

    <!-- Notifications -->
    <div class="notif">
        <div class="recent-activity">
            <div class="item-activity">
                <img src="img/avatar.png" alt="">
                <span>
                    <p class="message">
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    </p>
                    <small>2 Minutes Ago</small>
                </span>
                
            </div>
            <div class="item-activity">
                <img src="img/avatar.png" alt="">
                <span>
                    <p class="message">
                        Duis aute irure dolor in reprehenderit in
                    </p>
                    <small>4 Minutes Ago</small>
                </span>
            </div>
            <div class="item-activity">
                <img src="img/avatar.png" alt="">
                <span>
                    <p class="message">
                        Excepteur sint occaecat cupidatat non proident
                    </p>
                    <small>5 Minutes Ago</small>
                </span>
            </div>
            <div class="item-activity">
                <img src="img/avatar.png" alt="">
                <span>
                    <p class="message">
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    </p>
                    <small>2 Minutes Ago</small>
                </span>
                
            </div>
            <div class="item-activity">
                <img src="img/avatar.png" alt="">
                <span>
                    <p class="message">
                        Duis aute irure dolor in reprehenderit in
                    </p>
                    <small>4 Minutes Ago</small>
                </span>
            </div>
            <div class="item-activity">
                <img src="img/avatar.png" alt="">
                <span>
                    <p class="message">
                        Excepteur sint occaecat cupidatat non proident
                    </p>
                    <small>5 Minutes Ago</small>
                </span>
            </div><div class="item-activity">
                <img src="img/avatar.png" alt="">
                <span>
                    <p class="message">
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    </p>
                    <small>2 Minutes Ago</small>
                </span>
                
            </div>
            <div class="item-activity">
                <img src="img/avatar.png" alt="">
                <span>
                    <p class="message">
                        Duis aute irure dolor in reprehenderit in
                    </p>
                    <small>4 Minutes Ago</small>
                </span>
            </div>
            <div class="item-activity">
                <img src="img/avatar.png" alt="">
                <span>
                    <p class="message">
                        Excepteur sint occaecat cupidatat non proident
                    </p>
                    <small>5 Minutes Ago</small>
                </span>
            </div>
        </div>
        <small class="see-more">See All</small>
    </div>
</div>

<script>
    const iconBell = document.querySelector('.icon-bell')
    const notifBox = document.querySelector('.notif')


    iconBell.addEventListener('click', ()=>{
        notifBox.classList.toggle('active')
    })

// DOUGNUT CHART 
    const douhgnutLabels = [
        'Responses',
        'Requests',
        'Completed',
    ];

    const doughnutData = {
        labels: douhgnutLabels,
        datasets: [{
        label: 'Emergencies',
        backgroundColor:[
            '#CD3F3E',
            '#FB9935',
            '#8C0909'
        ], 
            
        // borderColor: '#323232',
        data: [20, 30, 45],
        }]
    };

    const doughnutConfig = {
        type: 'doughnut',
        data: doughnutData,
        options: {
            cutout: 75
        }
    };
            
    const doughnutChart = new Chart(
        document.getElementById('graph'),
        doughnutConfig
    );

// LOG CHART
    const logLabels = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
    ];
    const logData = {
    labels: logLabels,
    datasets: [{
        label: 'Responders Log',
        data: [
            65, 
            59, 
            80, 
            81, 
            56, 
            55, 
            40
        ],
        
        fill: false,
        borderColor: '#FB9935',
        tension: 0.1
    }]
    };

    const logConfig = {
        type: 'line',
        data: logData,
        };

    const logChart = new Chart(
        document.getElementById('logChart'),
        logConfig
    );
</script>
</x-layout>
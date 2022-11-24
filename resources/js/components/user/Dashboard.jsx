import React from 'react';
import ReactDOM from 'react-dom/client';

function Dashboard() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Dashboard Component</div>

                        <div className="card-body">I'm an the Index component!</div>

                        <a href='login/facebook'>Login with FB</a>
                        <a href='login/linkedin'>Login with Linkedin</a>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Dashboard;

if (document.getElementById('clientDashboard')) {
    const Index = ReactDOM.createRoot(document.getElementById("clientDashboard"));

    Index.render(
        <React.StrictMode>
            <Dashboard/>
        </React.StrictMode>
    )
}

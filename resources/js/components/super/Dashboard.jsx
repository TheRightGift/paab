import React from 'react';
import ReactDOM from 'react-dom/client';

function Dashboard() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Admin Dashboard Component</div>

                        <div className="card-body">Hooray you are the an Admin!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Dashboard;

if (document.getElementById('superDashboard')) {
    const Index = ReactDOM.createRoot(document.getElementById("superDashboard"));

    Index.render(
        <React.StrictMode>
            <Dashboard/>
        </React.StrictMode>
    )
}

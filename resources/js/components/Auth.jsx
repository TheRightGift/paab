import React from 'react';
import ReactDOM from 'react-dom/client';

function Dashboard() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Register/Login</div>

                        <div className="card-body">
                            <input type="text"  className='input' id='firstname'/>
                            <input type="text"  className='input' id='lastname'/>
                            <input type="text"  className='input' id='phone'/>
                            <input type="text"  className='input' id='email'/>
                            <input type="text"  className='input' id='password'/>
                            <input type="submit" value="Register" />
                            Or <a href='!#'>Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Dashboard;

if (document.getElementById('adminDashboard')) {
    const Index = ReactDOM.createRoot(document.getElementById("adminDashboard"));

    Index.render(
        <React.StrictMode>
            <Dashboard/>
        </React.StrictMode>
    )
}

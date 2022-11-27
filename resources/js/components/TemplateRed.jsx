import React from 'react';
import ReactDOM from 'react-dom/client';

function Template1Red() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card red">
                        <div className="card-header">Your Red Template</div>

                        <div className="card-body">
                            <h6>My Services</h6>
                            <ol>
                                <li>House warming</li>
                                <li>Wireframing</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Template1Red;

if (document.getElementById('docred')) {
    const Index = ReactDOM.createRoot(document.getElementById("docred"));

    Index.render(
        <React.StrictMode>
            <Template1Red/>
        </React.StrictMode>
    )
}

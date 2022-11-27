import React from 'react';
import ReactDOM from 'react-dom/client';

function TemplateBlue() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card blue">
                        <div className="card-header">Your Blue Template</div>

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

export default TemplateBlue;

if (document.getElementById('docblue')) {
    const Index = ReactDOM.createRoot(document.getElementById("docblue"));

    Index.render(
        <React.StrictMode>
            <TemplateBlue/>
        </React.StrictMode>
    )
}

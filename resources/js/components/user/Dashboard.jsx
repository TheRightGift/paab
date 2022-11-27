import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom/client";

function Dashboard() {
    const [name, setName] = useState("");
    const [template, setTemplate] = useState("");
    const [tenants, setTenants] = useState([]);
    const [templateToEdit, setTemplateToEdit] = useState("");
    const [tenantToEdit, setTenantToEdit] = useState("");
    const [settingsUpdate, setSettingsUpdate] = useState(false);
    useEffect(() => {
        tenancies();
    },[]);
    const logout = () => {
        axios
            .post("/logout")
            .then((res) => {
                console.log(res);
            })
            .catch((err) => {
                console.log(err);
            });
    };
    let createTemplate = (e) => {
        e.preventDefault();

        let data = {
            template_id: template,
            name: name,
        };
        axios
            .post("/api/tenant", data)
            .then((res) => {
                if (res.data.status == 200) {
                    console.log(res);
                    // window.location.replace("/dashboard");
                } else {
                    alert("Invalid Credentials");
                }
            })
            .catch((err) => {
                console.log(err);
            });
    };
    let updateTemplate = (e) => {
        e.preventDefault();

        let data = {
            template_id: template,
            tenant_id: tenantToEdit
        };
        axios
            .post("/api/template-update", data)
            .then((res) => {
                if (res.data.status == 200) {
                    console.log(res);
                    alert(res.data.message);
                    // window.location.replace("/dashboard");
                } else {
                    alert("Error updating");
                }
            })
            .catch((err) => {
                console.log(err);
            });
    };
    const listTenancies = tenants.map((tenant) => (
        <div>
            <li>{tenant.id}</li>
            <button onClick={ () => (setTenantToEdit(tenant.id), setTemplateToEdit(tenant.template_id), setSettingsUpdate(!settingsUpdate), setTemplate(tenant.template_id))}>Edit</button>
        </div>
    ));
    let tenancies = () => {
        axios
            .get("/api/tenancies")
            .then((res) => {
                console.log(res);
                setTenants(res.data.tenants);
            })
            .catch((err) => {
                console.log(err);
            });
    };
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Dashboard Component</div>

                        <div className="card-body">
                            I'm an the Index component!
                        </div>

                        <p>Choose a template</p>
                        <form onSubmit={createTemplate}>
                            <input
                                type="radio"
                                name="template"
                                id="template"
                                value={3}
                                onChange={(e) => setTemplate(e.target.value)}
                                required
                            />{" "}
                            Template Red
                            <input
                                type="radio"
                                name="template"
                                id="template"
                                value={4}
                                onChange={(e) => setTemplate(e.target.value)}
                            />{" "}
                            Template Blue
                            <input
                                type="text"
                                name="name"
                                id="template"
                                value={name}
                                onChange={(e) => setName(e.target.value)}
                            />
                            <button
                                type="submit"
                                className="btn btn-primary"
                                id="loginBtn"
                            >
                                Create
                            </button>
                        </form>
                        <br />
                        <p>My Websites</p>
                        <ul>{listTenancies}</ul>
                        <h6>Update template</h6>
                        {
                            settingsUpdate ? 
                            <form onSubmit={updateTemplate}>
                                <input
                                    type="radio"
                                    name="template"
                                    id="template"
                                    value={3}
                                    defaultChecked={3 === template}
                                    onChange={(e) => setTemplate(e.target.value)}
                                    required
                                />{" "}
                                Template Red
                                <input
                                    type="radio"
                                    name="template"
                                    id="template"
                                    value={4}
                                    defaultChecked={4 === template}
                                    onChange={(e) => setTemplate(e.target.value)}
                                />{" "}
                                Template Blue
                                <button
                                    type="submit"
                                    className="btn btn-primary"
                                    id="loginBtn"
                                >
                                    Change
                                </button>
                            </form>
                            :
                            null
                        }
                        <a href="#!" onClick={logout}>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Dashboard;

if (document.getElementById("clientDashboard")) {
    const Index = ReactDOM.createRoot(
        document.getElementById("clientDashboard")
    );

    Index.render(
        <React.StrictMode>
            <Dashboard />
        </React.StrictMode>
    );
}

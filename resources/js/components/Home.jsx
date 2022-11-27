import axios from 'axios';
import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';

function Home() {
    const [firstname, setFirstname] = useState("");
    const [lastname, setLastname] = useState("");
    const [phone, setPhone] = useState("");
    const [email, setEmail] = useState("");
    const [password, setpassword] = useState("");

    let loginUser = (e) => {

        e.preventDefault();

        let data = {
            email: email,
            password: password,
        }
        axios.post('/login', data).then(res => {
            if (res.data.status == 200) {
                // console.log(res);
                localStorage.setItem("token", res.data.access_token);
                window.location.replace('/dashboard') 
            }
            else {
                alert('Invalid Credentials');
            }
        }).catch(err => {
            console.log(err);
        })
    }

    const handleSubmit = (e) => {
        e.preventDefault();
        let data = {
            firstname: firstname,
            lastname: lastname,
            phone: phone,
            email: email,
            password: password,
        }
        axios.post('/api/register', data).then(res => {
            console.log(res);
        }).catch(err => {
            console.log(err);
        })
    };

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Register/Login</div>

                        <div className="card-body">
                            <form onSubmit={handleSubmit}>
                                <div>
                                    <input
                                        className="form-control"
                                        type="text"
                                        placeholder="Firstname"
                                        value={firstname}
                                        onChange={(e) =>
                                            setFirstname(e.target.value)
                                        }
                                        required
                                    />
                                </div>
                                <div>
                                    <input
                                        className="form-control"
                                        type="text"
                                        placeholder="Lastname"
                                        value={lastname}
                                        onChange={(e) =>
                                            setLastname(e.target.value)
                                        }
                                        required
                                    />
                                </div>
                                <div>
                                    <input
                                        className="form-control"
                                        type="text"
                                        placeholder="Email"
                                        value={email}
                                        onChange={(e) =>
                                            setEmail(e.target.value)
                                        }
                                        required
                                    />
                                </div>
                                <div>
                                    <input
                                        className="form-control"
                                        type="text"
                                        placeholder="Phone"
                                        value={phone}
                                        onChange={(e) =>
                                            setPhone(e.target.value)
                                        }
                                        required
                                    />
                                </div>
                                <div>
                                    <input
                                        className="form-control"
                                        type="text"
                                        placeholder="Password"
                                        value={password}
                                        onChange={(e) =>
                                            setpassword(e.target.value)
                                        }
                                        required
                                    />
                                </div>
                                
                                <button
                                    type="submit"
                                    className="btn btn-primary"
                                    id="loginBtn"
                                >
                                    Register
                                </button> 
                                Or <a href='!#'>Login</a><br></br>
                                <a href='login/facebook'>Login with FB</a><br></br>
                                <a href='login/linkedin'>Login with Linkedin</a>
                            </form>
                            <form onSubmit={loginUser}>
                                <div>
                                    <input
                                        className="form-control"
                                        type="text"
                                        placeholder="Email"
                                        value={email}
                                        onChange={(e) =>
                                            setEmail(e.target.value)
                                        }
                                        required
                                    />
                                </div>
                                <div>
                                    <input
                                        className="form-control"
                                        type="text"
                                        placeholder="Password"
                                        value={password}
                                        onChange={(e) =>
                                            setpassword(e.target.value)
                                        }
                                        required
                                    />
                                </div>
                                
                                <button
                                    type="submit"
                                    className="btn btn-primary"
                                    id="loginBtn"
                                >
                                    Login
                                </button> 
                                Or <a href='!#'>Register</a><br></br>
                                <a href='login/facebook'>Login with FB</a><br></br>
                                <a href='login/linkedin'>Login with Linkedin</a>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    );
}

export default Home;

if (document.getElementById('home')) {
    const Index = ReactDOM.createRoot(document.getElementById("home"));

    Index.render(
        <React.StrictMode>
            <Home/>
        </React.StrictMode>
    )
}

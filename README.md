client => req => server  - (verify) |
client (store) < resp  <  payload < |
-------------------
client (auth with stored token) => server (verify auth) |
client < resp < required data <                         |

Client
    persist*
ServerIdentity 
    Payload
    JwtFacade (encode, decode)
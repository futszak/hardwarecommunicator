# hardwarecommunicator

Directory contains files:
  - communicator             - script in python for server side
  - communicatorconfig.py    - config for communicator
  - sender                   - script in python for remote device
  - senderconfig.py          - configuration data for sender
  - rc.local                 - /etc/rc.local - start script

1.Hardware (remote device side)
- OrangePI light with Armbian (linux)
- For car (12V) impulse converter step down (7-24V input, 5V output 2A)
- GPS/UART module with small antenna
- Solid State Relay
- GSM/HSPA/LTE USB modem (eg.Huawei E173)

2.Basic functionality (remote device)
- Recieving GPS data from air
- Simply router GSM-WiFi
- Switching on/off driven circuit
- Saving recieved data on sd card, when is problem with connection.
- Sending saved data, when connection was fixed.

3.Additional functionality
- Working in 2 modes: live and economic
- Compression data before sending in economic mode.
- Creating fake GPS data (option)
- Autorestart program after time (in config) if problem with connection
- Autorestart device after time if no data (from GPS)
- Restart script and reset device on demand

More details on http://sender.tkruk.it/

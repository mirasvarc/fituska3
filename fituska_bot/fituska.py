import discord
import os
import requests

client = discord.Client()

@client.event
async def on_ready():
    print('We have logged in as {0.user}'.format(client))

@client.event
async def on_message(message):
    if message.author == client.user:
        return

    if message.content.startswith('$hello'):
        await message.channel.send('Hello!')

    if str(message.content).split(" ")[0] == "$getuser":

        if len(str(message.content).split(" ")) != 2:
            await message.channel.send("Zadej id uživatele!")
            return

        id = str(message.content.split(" ")[1])
        r = requests.get("http://localhost:8000/api/user/get/{id}".format(id = id))
        data = r.json()
        await message.channel.send(
            "Username: %s\nJméno: %s\nPříjmení: %s\n"%(data['username'], data['first_name'], data['surname'])
        )





client.run('ODEyMzMzMjk2MDI4ODc2ODEx.YC_OVg.YUHowf7VO3ZDunRpU6e2D4oOhUQ')

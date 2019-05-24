#ifndef CSOCKET_H
#define CSOCKET_H
#include <QTcpSocket>
#include <QObject>
class CSocket
{
QTcpSocket* socket;
public:
	CSocket();
};

#endif // CSOCKET_H
